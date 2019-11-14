<?php

abstract class PaymentType extends BasicEnum
{
    // Thanh toán trực tiếp
    const Exchanging = 1;

    // Thanh toán ghi nợ
    const Provisioning = 2;
}
