<?php

namespace Podorozhny\Twig\Extension;

class MoneyExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('money_*', array($this, 'moneyFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('usd', array($this, 'usdFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('eur', array($this, 'eurFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('gbp', array($this, 'gbpFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('btc', array($this, 'btcFilter'), array('is_safe' => array('html'))),
        );
    }

    public function moneyFilter($currency, $value, $decimals = 2) {
        $currencySigns = [
            'rub' => ' <i class="fa fa-rub"></i>',
            'usd' => '<i class="fa fa-usd"></i>',
            'eur' => '<i class="fa fa-eur"></i>',
            'gbp' => '<i class="fa fa-gbp"></i>',
            'btc' => '<i class="fa fa-btc"></i>',
        ];

        $isNegative = ($value < 0);

        $money = number_format(abs($value), $decimals, '.', (in_array($currency, ['rub']) ? ' ' : ''));

        if (in_array($currency, ['rub']) && isset($currencySigns[$currency])) {
            $money .= $currencySigns[$currency];
        } else {
            if (isset($currencySigns[$currency])) {
                $money = $currencySigns[$currency] . $money;
            }
        }

        if ($isNegative) $money = '&minus;' . $money;

        return '<nobr>' . $money . '</nobr>';
    }

    public function getName() {
        return 'money_extension';
    }
}
