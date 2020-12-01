<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Widgets\Table;
use App\Models\CouponPublisher;
use Dcat\Admin\Support\LazyRenderable;

class PublisherCodeTable extends LazyRenderable
{
    public function render()
    {
        $id = $this->key;

        $couponPublisher = CouponPublisher::find($id);

        $data = $couponPublisher->codes()->get()->toArray();

        $couponPublisherData = [];

        foreach ($data as $key => $vo) {
            $couponPublisherData[$key]['name'] = $vo['name'];
            $couponPublisherData[$key]['code'] = $vo['code'];
            $couponPublisherData[$key]['description'] = $vo['description'];
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
