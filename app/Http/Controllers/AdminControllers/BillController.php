<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Events\ConfirmBill;
use Pusher\Pusher;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::orderBy('date', 'desc');
        $bills = $bills->select(['bill_id', 'user_id', 'date', 'phone_number', 'status', 'created_at', 'updated_at']);
        if (!empty(request()->input('bill_id'))) {
            $bills = $bills->where('bill_id', 'LIKE', '%' . request()->input('bill_id') . '%');
        }
        if (!empty(request()->input('user_id'))) {
            $bills = $bills->where('user_id', 'LIKE', '%' . request()->input('user_id') . '%');
        }
        if (request()->input('status') != null && request()->input('status') < 5) {
            $bills = $bills->where('status', '=', request()->input('status'));
        }
        $bills = $bills->selectSub(function ($query) {
            $query->selectRaw('COALESCE(SUM(price * quanlity), 0)')
                ->from('Bill_details')
                ->whereColumn('Bill_details.bill_id', 'Bill.bill_id');
        }, 'total_price');
        $bills = $bills->paginate(5);
        return view('admin-views.bill.index', compact('bills'));
    }
    public function detail($bill_id)
    {
        $billAddress = DB::table('Bill')
            ->join('User', 'Bill.user_id', '=', 'User.user_id')
            ->select(
                'Bill.address as user_address',
                'Bill.phone_number as user_phone',
                'User.name as user_name',
                'User.email as user_email',
                'Bill.status as status'
            )
            ->where('Bill.bill_id', $bill_id)->first();
        $billProducts = DB::table('Bill_details')
            ->join('Products_details', 'Bill_details.product_details_id', '=', 'Products_details.product_details_id')
            ->join('Products', 'Products_details.product_id', '=', 'Products.product_id')
            ->join('Size', 'Products_details.size_id', '=', 'Size.size_id')
            ->join('Flavour', 'Products_details.flavour_id', '=', 'Flavour.flavour_id')
            ->select(
                'Bill_details.bill_product_id',
                'Products.productname as product_name',
                'Products_details.price as product_price',
                'Size.value as product_size',
                'Flavour.value as product_flavour',
                'Bill_details.quanlity as product_quantity',
                DB::raw('Bill_details.price * Bill_details.quanlity as product_total_price')
            )
            ->where('Bill_details.bill_id', $bill_id)
            ->get();

        if ($billAddress) {
            return view('admin-views.bill.detail', compact('billAddress', 'billProducts', 'bill_id'));
        }
        return abort(404);
    }

    public function update_status($bill_id, Request $request)
    {
        $bill = Bill::find($bill_id);
        if (!$bill) {
            return abort(404);
        };
        $userId = $bill->user_id;
        $status = $request->input('status');

        $bill->status = $status;
        $bill->save();

        //make notifications
        $content = '';
        if ($status == 1) {
            $content = 'Đơn hàng ' . $bill_id . ' đang được vận chuyển đến bạn!';
        } else {
            $content = 'Đơn hàng ' . $bill_id . ' đã bị hủy!';
        }

        $data['content'] = $content;
        $data['created_at'] = time();
        $noti = DB::table('Notifications')->insert([
            'user_id' => $userId,
            'content' => $content
        ]);

        if ($noti) {
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $privateChannelName = 'private-channel-user-' . $userId;
            // dd($data);
            $pusher->trigger($privateChannelName, 'send-noti', $data);
            // return 'ok sende';
            return redirect('/admin/bill/' . $bill_id)->with('success', 'Bill status updated successfully');
        }
        dd($noti);
        return redirect('/admin/bill/' . $bill_id)->with('success', 'Bill status updated successfully');
    }

    public function getBillCountByDateAndStatus()
    {
        // Execute the query and store the results in a variable
        $billCount1 = Bill::select(DB::raw("DATE_FORMAT(date, '%d-%b-%Y') as dateOrder"),'status', DB::raw('COUNT(status) as countBill'))
        ->where('status', '=', 1)
        ->groupBy('dateOrder', 'status')
        ->get();

        $billCount2 = Bill::select(DB::raw("DATE_FORMAT(date, '%d-%b-%Y') as dateOrder"),'status', DB::raw('COUNT(status) as countBill'))
        ->where('status', '=', 2)
        ->groupBy('dateOrder', 'status')
        ->get();

        // Return the results as JSON
        return response()->json(['data1' => $billCount1, 'data2' => $billCount2]);
    }
}
