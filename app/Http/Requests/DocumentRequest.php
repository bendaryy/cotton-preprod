<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            "qty"                    => 'required|array',
            "product_discount"       =>'',
            "product_price"          => '',
            "product_code"           => '',
            "product_id"             => '',
            "sale_unit"              => '',
            "net_unit_price"         => '',
            "discount"               => '',
            "tax_rate"               => '',
            "subtotal"               => '',
            "customer_id"            => '',
            "shipping"               => '',
            "tax-total"              => '',
            "discount-total"         => '',
            "total_quantity"         => '',
            "total-quantity"         => '',
            "total_price"            => '',
            "bank_name"              => '',
            "bank_accountno"         => '',
            "swift_code"             => '',
            "bank_iban"              => '',
            "bank_address"           => '',
            "payment_terms"          => '',
            "order_purchase_ref"     => '',
            "order_desc"             => '',
            "orderder_reference"     => '',
            "order_sales_desc"       => '',
            "proforma"               => '',
            "approach"               => '',
            "packaging"              => '',
            "validity"               => '',
            "export_port"            => '',
            "country_origin"         => '',
            "cross_weight"           => '',
            "net_weight"             => '',
            "delivery_terms"         => '',
        ];
    }



    // "qty" => '',
    //         "product_discount" =>'',
    //         "product_price" => '',
    //         "product_code" => '',
    //         "product_id" => '',
    //         "sale_unit" => '',
    //         "net_unit_price" => '',
    //         "discount" => '',
    //         "tax_rate" => '',
    //         "subtotal" => '',
    //         "customer_id" => "3"
    //         "shipping" => '',
    //         "tax-total" => '',
    //         "discount-total" => '',
    //         "total_quantity" => '',
    //         "total-quantity" => '',
    //         "total_price" => '',
    //         "bank_name" => '',
    //         "bank_accountno" => '',
    //         "swift_code" => '',
    //         "bank_iban" => '',
    //         "bank_address" => '',
    //         "payment_terms" => '',
    //         "order_purchase_ref" => '',
    //         "order_desc" => '',
    //         "orderder_reference" => '',
    //         "order_sales_desc" => '',
    //         "proforma" => '',
    //         "approach" => '',
    //         "packaging" => '',
    //         "validity" => '',
    //         "export_port" => '',
    //         "country_origin" => '',
    //         "cross_weight" => '',
    //         "net_weight" => '',
    //         "delivery_terms" => '',
}
