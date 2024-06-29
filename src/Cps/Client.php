<?php

declare(strict_types=1);

namespace Ydg\MeituanMediaSdk\Cps;

use Ydg\MeituanMediaSdk\MeituanClient;

class Client extends MeituanClient
{
    /**
     * 商品查询接口
     * @param mixed $params
     * @example params['platform']⽤[非必填]商品所属业务一级分类类型：1 到家及其他业务类型，2 到店业务类型（包含到店美食、休闲生活、酒店、门票）；不填则默认1
     * @example params['bizLine']⽤[非必填]商品所属业务二级分类类型；当字段platform为1，选择到家及其他业务类型时：5 医药 ，不填则默认为null，返回外卖商品券；当字段platform为2，选择到店业务类型时：1 到餐，2 到综 3：酒店 4：门票 不填则默认1
     * @example params['longitude']⽤[非必填]定位经纬度的经度，请传递经度*100万倍的整形数字，如经度116.404*100万倍为116404000； 针对到店、到家医药商品业务类型，若未输入经纬度，则默认北京；针对到家外卖商品券业务类型，若未输入经纬度，则默认全国
     * @example params['latitude']⽤[非必填]定位经纬度的纬度，请传递纬度*100万倍的整形数字，如纬度39.928*100万倍为39928000; 针对到店、到家医药商品业务类型，若未输入经纬度，则默认北京；针对到家外卖商品券业务类型，若未输入经纬度，则默认全国
     * @example params['priceCap']⽤[非必填]筛选商品售卖价格上限【单位元】
     * @example params['priceFloor']⽤[非必填]筛选商品价格下限【单位元】
     * @example params['commissionCap']⽤[非必填]筛选商品佣金值上限【单位元】，若商品按照佣金值进行范围筛选，则排序只能按照佣金降序，本字段只支持到店业务类型、到家医药业务类型
     * @example params['commissionFloor']⽤[非必填]筛选商品佣金值下限【单位元】，若商品按照佣金值进行范围筛选，则排序只能按照佣金降序，本字段只支持到店业务类型、到家医药业务类型
     * @example params['vpSkuViewIds']⽤[非必填]商品ID集合，非必填，若填写该字段则不支持其他筛选条件，集合里ID用英文“,”隔开。一次最多支持查询20个售卖券ID
     * @example params['listTopiId']⽤[非必填]选品池榜单主题ID，支持查询1:精选，2:今日必推、3:同城热销、4:跟推爆款的商品售卖券；到店、到家医药业务类型，本项为必填，且只支持传枚举3
     * @example params['pageSize']⽤[非必填]分页大小，不填返回默认分页20
     * @example params['pageNo']⽤[非必填]页数，不填返回默认页数1
     * @example params['sortField']⽤[非必填]1）未入参榜单listTopicId时：支持1 售价排序、2 销量排序；2）入参榜单listTopicId时：当platform为1，选择到家业务类型：外卖商品券类型，支持1 售价排序、 2 销量降序、 3佣金降序，不填则默认为1；到家医药类型，支持2 销量降序、 3 佣金降序，不填则默认为2； 当platform为2，选择到店业务类型：支持2 销量降序、 3佣金降序，不填则默认为2
     * @example params['ascDescOrder']⽤[非必填]仅对到家业务类型生效，未入参榜单listTopicId时：1 升序，2 降序； 入参榜单listTopicId时：1 升序，2 降序，并且仅对sortField为1售价排序的时候生效，其他筛选值不生效； 其他说明：不填则默认为1升序
     */
    public function query_coupon($params): array
    {
        return $this->post('/cps_open/common/api/v1/query_coupon', $params);
    }

    /**
     * 获取推广链接接口
     * @param mixed $params
     * @example params['platform']⽤[非必填]商品所属业务一级分类类型：1 到家及其他业务类型，2 到店业务类型（包含到店美食、休闲生活、酒店、门票）；不填则默认1
     * @example params['bizLine']⽤[非必填]商品所属业务二级分类类型；当字段platform为1，选择到家及其他业务类型时：5 医药 ，不填则默认为null，返回外卖商品券；当字段platform为2，选择到店业务类型时：1 到餐，2 到综 3：酒店 4：门票 不填则默认1
     * @example params['actId']⽤[非必填]活动物料ID，我要推广-活动推广中第一列的id信息（和商品id、活动链接三选一填写，不能全填）
     * @example params['skuViewId']⽤[非必填]商品id，对商品查询接口返回的skuViewid（和活动物料ID、活动链接三选一，不能全填）
     * @example params['sid']⽤[非必填]二级媒体身份标识，用于渠道效果追踪，限制64个字符，仅支持英文、数字和下划线
     * @example params['linkType']⽤[必填]链接类型，枚举值：1 H5长链接；2 H5短链接；3 deeplink(唤起)链接；4 微信小程序唤起路径
     * @example params['text']⽤[非必填]只支持到家外卖商品券、买菜业务类型链接和活动物料链接。活动链接，即想要推广的目标链接，出参会返回成自己可推的链接，限定为当前可推广的活动链接或者商品券链接，请求内容尽量保持在200字以内，文本中仅存在一个http协议头的链接
     */
    public function get_referral_link($params): array
    {
        return $this->post('/cps_open/common/api/v1/get_referral_link', $params);
    }

    /**
     * 查询订单接口
     * @param mixed $params
     * @example params['platform']⽤[非必填]商品所属业务一级分类类型：1 到家及其他业务类型，2 到店业务类型（包含到店美食、休闲生活、酒店、门票）；不填则默认1
     * @example params['businessLine']⽤[非必填]业务线标识；1）当platform为1，选择到家及其他业务类型时，业务线枚举为1：外卖订单 WAIMAI 2：闪购红包 3：酒旅 4：美团电商订单（团好货） 5：医药 6：拼好饭 7：商品超值券包 COUPON 8：买菜 MAICAI 11：闪购商品；不传则默认传空表示非售卖券包订单类型的全部查询。若输入参数含7 商品超值券包，则只返回商品超值券包订单；2）当platform为2，选择到店业务类型 时，业务线枚举1：到餐 2：到综 3：酒店 4：门票，不填则默认传1
     * @example params['actId']⽤[非必填]活动物料id，我要推广-活动推广中第一列的id信息，不传则返回所有actId的数据，建议查询订单时传入actId
     * @example params['sid']⽤[非必填]二级推广位id，最长64位，不传则返回所有sid的数据
     * @example params['orderId']⽤[非必填]订单id，入参后可与业务线标识businessLine配合使用，输入的orderId需要与businessLine能对应上。举例：如查询商品超值券包订单时orderId传券包订单号，businessLine传7；除此以外其他查询筛选条件不生效，不传业务线标识businessLine则默认仅查非券包订单
     * @example params['startTime']⽤[非必填]查询时间类型对应的查询开始时间，10位时间戳表示，单位秒
     * @example params['endTime']⽤[非必填]查询时间类型对应的查询结束时间，10位时间戳表示，单位秒
     * @example params['page']⽤[非必填]页码，默认1，从1开始,若searchType选择2，本字段必须传1，若不传参数默认1
     * @example params['limit']⽤[非必填]查询时间类型对应的查询结束时间，10位时间戳表示，单位秒
     * @example params['queryTimeType']⽤[非必填]查询时间类型，枚举值， 1 按订单支付时间查询， 2 按照更新时间查询， 默认为1
     * @example params['tradeType']⽤[非必填]交易类型，1表示CPS，2表示CPA
     * @example params['scrollId']⽤[非必填]分页id，当searchType选择2逐页查询时，本字段为必填。若不填写，默认查询首页。取值为上一页查询时出参的scrollId字段
     * @example params['searchType']⽤[非必填]订单分页查询方案选择，不填则默认为1。1 分页查询（最多能查询到1万条订单），当选择本查询方案，page参数不能为空。此查询方式后续不再维护，建议使用2逐页查询。2 逐页查询（不限制查询订单数，只能逐页查询，不能指定页数），当选择本查询方案，需配合scrollId参数使用
     * @example params['cityNames']⽤[非必填]可输入城市名称圈定特定城市的订单，单次最多查询10个城市（英文逗号分隔）。不传则默认全部城市订单。 注：如需确认城市具体名称，可参考后台订单明细页的城市筛选项，或参考具体活动的城市命名。目前只支持到家业务类型-商品超值券包业务线。
     */
    public function query_order($params): array
    {
        return $this->post('/cps_open/common/api/v1/query_order', $params);
    }
}
