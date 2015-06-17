<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/16/15
 * Time: 11:27 PM
 */

namespace App\Src\Purchase;


use App\Core\AbstractRepository;

class PurchaseRepository extends AbstractRepository {

    public function __construct(Purchase $purchase) {
        $this->model = $purchase;
    }
}