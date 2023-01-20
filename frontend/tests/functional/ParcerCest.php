<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class ParcerCest
{
    protected $formId = '#search-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
    }

    public function searchCadastraNumber(FunctionalTester $I)
    {
        $I->dontSeeRecord('common\models\Plot', [
            'cadastraNumber' => '69:27:0000022:1306',
        ]);

        $I->submitForm(
            $this->formId,
            [
                'SignupForm[textInput]'  => '69:27:0000022:1306',
            ]
        );

        $I->dontSeeRecord('common\models\Plot', [
            'cadastraNumber' => '69:27:0000022:1306',
        ]);
    }
}
