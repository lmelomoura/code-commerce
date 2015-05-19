<?php namespace CodeCommerce\Http\Requests;

use CodeCommerce\Http\Requests\Request;


class ProductRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $resquestIpunt = $this->all();
        if (!$this->has('featured'))
        {
            $resquestIpunt['featured'] = 0;
        }
        if (!$this->has('recommended'))
        {
            $resquestIpunt['recommended'] = 0;
        }

        $this->replace($resquestIpunt);



        return [
            'name' => 'Required|min:5|max:30',
            'description' => 'Required',
            'price' => 'Required|Numeric'
        ];
	}

}
