<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Table;
use App\Models\CouponBusiness;
use Dcat\Admin\Support\LazyRenderable;

class BusinessCodeTable extends LazyRenderable
{
    public function render()
    {
        Admin::style('.table td{padding: 1.5rem .69rem}');

        $id = $this->key;

        $couponBusiness = CouponBusiness::find($id);

        $data = $couponBusiness->codes()->get()->toArray();

        $couponPublisherData = [];

        foreach ($data as $key => $vo) {
            $couponPublisherData[$key]['name'] = $vo['name'];
            $couponPublisherData[$key]['code'] = $vo['code'];
            $couponPublisherData[$key]['description'] = "<span class='label' style='background:#586cb1'>" . $vo['description'] . "</span>";
            $couponPublisherData[$key]['usage'] = $vo['used'] . '/' . $vo['total'];
        }

        $titles = [
            '优惠券名称',
            '优惠券编码',
            '优惠券描述',
            '优惠券使用量',
        ];

        return Table::make($titles, $couponPublisherData);
    }
}
