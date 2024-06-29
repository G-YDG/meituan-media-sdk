<?php

declare(strict_types=1);

namespace YdgTest\MeituanMediaSdk;

/**
 * @internal
 * @coversNothing
 */
class CpsTest extends AbstractTest
{

    public function test_query_coupon_and_get_referral_link()
    {
        $couponResponse = $this->getApp()->cps->query_coupon([
            'platform' => 1,
            'pageNo' => 1,
            'pageSize' => 10,
        ]);
        $this->assertArrayHasKey('code', $couponResponse);
        $this->assertEquals(0, $couponResponse['code']);

        $linkResponse = $this->getApp()->cps->get_referral_link([
            'skuViewId' => $couponResponse['data'][0]['couponPackDetail']['skuViewId'],
            'sid' => 'api_234979',
            'linkType' => 2,
        ]);
        $this->assertArrayHasKey('code', $linkResponse);
        $this->assertEquals(0, $linkResponse['code']);
    }


    public function test_query_order()
    {
        $params = [
            'platform' => 1,
            'queryTimeType' => 1,
            'startTime' => time() - 1200,
            'endTime' => time(),
            'page' => 1,
            'limit' => 10,
        ];
        $response = $this->getApp()->cps->query_order($params);

        $this->assertArrayHasKey('code', $response);
        $this->assertEquals(0, $response['code']);
    }
}
