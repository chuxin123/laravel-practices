<?php

namespace App\Enums;

enum OrderValidateEnum: int implements BaseValidate
{

    case FAIL_ORDER_NO = -110115;
    case FAIL_SUB_ORDER = -110112;
    case REQUEST_ERROR = -400000;


    /**
     * error错误 110001-110100
     */
    case ERROR_ORDER_NO = -110001;
    case ERROR_PROCESS = -110002;
    case ERROR_MODIFY_REMARK = -110003;
    case ERROR_REQUEST_REPEAT = -110004;


    /**
     * 流程错误 110100-110300
     */
    case PROJECT_NOT_EXIST = -110101;
    case ORDER_NOT_EXIST = -110102;
    case INDUSTRY_NOT_EXIST = -110103;
    case PROJECT_NO_NOT_EXIST = -110104;
    case FAIL_GET_PRODUCT_GROUP = -110105;
    case REFUND_URL_NOT_EXIST = -1101051;
    case FAIL_PRE_CREATE = -110106;
    case FAIL_SAVE_ORDER = -110107;
    case FAIL_CONFIRM_ORDER = -110108;
    case FAIL_CANCEL_ORDER = -110109;
    case FAIL_LOCK_ORDER = -110110;
    case FAIL_CHANGE_ORDER = -110111;

    case FAIL_QUERY_ORDER = -110113;
    case FAIL_NO_DATA = -110114;

    case FAIL_EXIST_REFUNDING_ORDER = -110116;
    case FAIL_REFUND = -110117;
    case FAIL_CANCEL_REFUND = -110118;

    function getCode(): int
    {
        return $this->value;
    }

    public function getMessage(): string
    {
        return match ($this) {
            self::FAIL_ORDER_NO => "主订单号格式错误",
            self::FAIL_SUB_ORDER => "子订单单号错误",
            self::ERROR_ORDER_NO => "订单号重复",
            self::ERROR_PROCESS => "处理流程错误",
            self::ERROR_MODIFY_REMARK => "修改订单备注错误",
            self::ERROR_REQUEST_REPEAT => "请不要重复请求",
            self::PROJECT_NOT_EXIST => "项目不存在",
            self::ORDER_NOT_EXIST => "订单不存在",
            self::INDUSTRY_NOT_EXIST => "行业不存在",
            self::PROJECT_NO_NOT_EXIST => "项目编号不存在",
            self::FAIL_GET_PRODUCT_GROUP => "产品行业分组失败",
            self::REFUND_URL_NOT_EXIST => "退款地址不存在",
            self::FAIL_PRE_CREATE => "预下单失败",
            self::FAIL_SAVE_ORDER => "保存订单失败",
            self::FAIL_CONFIRM_ORDER => "确认订单失败",
            self::FAIL_CANCEL_ORDER => "取消订单失败",
            self::FAIL_LOCK_ORDER => "加锁失败!请重试",
            self::FAIL_CHANGE_ORDER => "变更订单信息失败",
            self::FAIL_QUERY_ORDER => "查询失败",
            self::FAIL_NO_DATA => "查询无数据",
            self::FAIL_EXIST_REFUNDING_ORDER => "订单存在未完成的退款单",
            self::FAIL_REFUND => "退款失败",
            self::FAIL_CANCEL_REFUND => "取消订单,退款失败",

            default => "请求失败",
        };
    }


}
