<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    const GET_COMPANY_URL = 'https://autoform.ekosystem.slovensko.digital/api/corporate_bodies/search?q=';

    public function getCompanyData()
    {
        $param = urlencode(request('search'));

        $companies = $this->getData($param);

        $companies = $this->prepareData($companies);

        return $companies;
    }

    private function getData($param)
    {
        $client = new Client();

        try {
            $res = $client->request('GET', self::GET_COMPANY_URL . $param . '&private_access_token=' . env('SLOVENSKO_DIGITAL_API_KEY'));
        } catch (\Exception $e) {
            //todo catch exception ked nejde internet
            throw new \Exception($e);
        }

        if (isset($res)) {
            return json_decode($res->getBody(), true);
        }
        return response()->json([false]);
    }

    private function prepareData($companies)
    {
        return $ownStructure = array_map(function ($company) {
            return [
                'id'        => $company['id'],
                'name'      => $company['name'],
                'ico'       => preg_replace('/\s+/', '', $company['cin']),
                'vat'       => $company['vatin'],
                'street'    => $company['street'],
                'house_number' => $company['street_number'],
                'zip'       => preg_replace('/\s+/', '', $company['postal_code']),
                'town'      => $company['municipality'],
                'country'   => $company['country'],
            ];
        }, $companies);
    }
}
