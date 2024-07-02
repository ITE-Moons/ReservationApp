<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted' => 'يجب قبول الحقل (:attribute)',
    'accepted_if' => 'الحقل (:attribute) مقبول في حال ما إذا كان (:other) يساوي (:value)',
    'active_url' => 'الحقل (:attribute) لا يُمثّل رابطًا صحيحًا',

    'after' => 'يجب على الحقل (:attribute) أن يكون تاريخًا لاحقًا للتاريخ الحالي',
    'after_or_equal' => 'الحقل (:attribute) يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ الحالي',
    'after_t' => 'يجب على الحقل (:attribute) أن يكون وقتاً لاحقًا للوقت الحالي',
    'after_or_equal_t' => 'الحقل (:attribute) يجب أن يكون وقتاً لاحقاً أو مطابقاً للوقت الحالي',


    'alpha' => 'يجب أن لا يحتوي الحقل (:attribute) سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل (:attribute) على حروف، أرقام ومطّات',
    'alpha_num' => 'يجب أن يحتوي (:attribute) على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل (:attribute) ًمصفوفة',
    'before' => 'يجب على الحقل (:attribute) أن يكون تاريخًا سابقًا للتاريخ (:date)',
    'before_or_equal' => 'الحقل (:attribute) يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ (:date)',
    'between' => [
        'array' => 'يجب أن يحتوي (:attribute) على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف (:attribute) بين :min و :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة (:attribute) بين :min و :max',
        'string' => 'يجب أن يكون عدد حروف النّص (:attribute) بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل (:attribute) إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل (:attribute)',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'الحقل (:attribute) ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي الحقل (:attribute) مع (:date)',
    'date_format' => 'لا يتوافق الحقل (:attribute) مع الشكل (:format)',
    'declined' => 'يجب رفض الحقل (:attribute)',
    'declined_if' => 'الحقل (:attribute) مرفوض في حال ما إذا كان (:other) يساوي (:value)',
    'different' => 'يجب أن يكون الحقلان (:attribute) و (:other) مُختلفان',
    'digits' => 'يجب أن يحتوي الحقل (:attribute) على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل (:attribute) بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ (:attribute) يحتوي على أبعاد صورة غير صالحة',
    'distinct' => 'للحقل (:attribute) قيمة مُكرّرة',
    'email' => 'يجب أن يكون (:attribute) عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ (:attribute) يجب ان ينتهي بأحد القيم التالية (:value)',
    'enum' => 'الحقل (:attribute) غير صحيح',
    'exists' => '(:attribute) غير صحيح',
    'file' => 'الـ (:attribute) يجب أن يكون من ملفا',
    'filled' => 'الحقل (:attribute) إجباري',
    'gt' => [
        'array' => 'الـ (:attribute) يجب ان يحتوي علي اكثر من (:value) عناصر/عنصر',
        'file' => 'الـ (:attribute) يجب ان يكون اكبر من (:value) كيلو بايت',
        'numeric' => 'الـ (:attribute) يجب ان يكون اكبر من (:value)',
        'string' => 'الـ (:attribute) يجب ان يكون اكبر من (:value) حروفٍ/حرفًا',
    ],
    'gte' => [
        'array' => 'الـ (:attribute) يجب ان يحتوي علي (:value) عناصر/عنصر او اكثر',
        'file' => 'الـ (:attribute) يجب ان يكون اكبر من او يساوي (:value) كيلو بايت',
        'numeric' => 'الـ (:attribute) يجب ان يكون اكبر من او يساوي (:value)',
        'string' => 'الـ (:attribute) يجب ان يكون اكبر من او يساوي (:value) حروفٍ/حرفًا',
    ],
    'image' => 'يجب أن يكون الحقل (:attribute) صورةً',
    'in' => 'الحقل (:attribute) غير صحيح',
    'in_array' => 'الحقل (:attribute) غير موجود في (:other)',
    'integer' => 'يجب أن يكون الحقل (:attribute) عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل (:attribute) عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون الحقل (:attribute) عنوان IPv4 ذا بنية صحيحة',
    'ipv6' => 'يجب أن يكون الحقل (:attribute) عنوان IPv6 ذا بنية صحيحة',
    'json' => 'يجب أن يكون الحقل (:attribute) نصا من نوع JSON',
    'lt' => [
        'array' => 'الـ (:attribute) يجب ان يحتوي علي اقل من (:value) عناصر/عنصر',
        'file' => 'الـ (:attribute) يجب ان يكون اقل من (:value) كيلو بايت',
        'numeric' => 'الـ (:attribute) يجب ان يكون اقل من (:value)',
        'string' => 'الـ (:attribute) يجب ان يكون اقل من (:value) حروفٍ/حرفًا',
    ],
    'lte' => [
        'array' => 'الـ (:attribute) يجب ان يحتوي علي اكثر من (:value) عناصر/عنصر',
        'file' => 'الـ (:attribute) يجب ان يكون اقل من او يساوي (:value) كيلو بايت',
        'numeric' => 'الـ (:attribute) يجب ان يكون اقل من او يساوي (:value)',
        'string' => 'الـ (:attribute) يجب ان يكون اقل من او يساوي (:value) حروفٍ/حرفًا',
    ],
    'mac_address' => 'يجب أن يكون الحقل (:attribute) عنوان MAC ذا بنية صحيحة',
    'max' => [
        'array' => 'يجب أن لا يحتوي الحقل (:attribute) على أكثر من :max عناصر/عنصر',
        'file' => 'يجب أن لا يتجاوز حجم الملف (:attribute) :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل (:attribute) مساوية أو أصغر لـ :max',
        'string' => 'يجب أن لا يتجاوز طول نص (:attribute) :max حروفٍ/حرفًا',
    ],
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : (:values)',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : (:values)',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل (:attribute) على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف (:attribute) على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل (:attribute) مساوية أو أكبر لـ :min',
        'string' => 'يجب أن يتكون الحقل (:attribute) من :min أحرف على الأقل',
    ],
    'multiple_of' => 'The (:attribute) must be a multiple of (:value)',
    'not_in' => 'الحقل (:attribute) غير صحيح',
    'not_regex' => 'الحقل (:attribute) نوعه غير صحيح',
    'numeric' => 'يجب على الحقل (:attribute) أن يكون رقمًا',
    'password' => 'The password is incorrect',
    'present' => 'يجب تقديم الحقل (:attribute)',
    'prohibited' => 'الحقل (:attribute) محظور',
    'prohibited_if' => 'الحقل (:attribute) محظور في حال ما إذا كان (:other) يساوي (:value)',
    'prohibited_unless' => 'الحقل (:attribute) محظور في حال ما لم يكون (:other) يساوي (:value)',
    'prohibits' => 'الحقل (:attribute) يحظر (:other) من اي يكون موجود',
    'regex' => 'صيغة الحقل (:attribute) غير صحيحة',
    'required' => 'الحقل (:attribute) مطلوب',
    'required_array_keys' => 'الحقل (:attribute) يجب ان يحتوي علي مدخلات للقيم التالية (:values)',
    'required_if' => 'الحقل (:attribute) مطلوب في حال ما إذا كان (:other) يساوي (:value)',
    'required_unless' => 'الحقل (:attribute) مطلوب في حال ما لم يكن (:other) يساوي (:values)',
    'required_with' => 'الحقل (:attribute) إذا توفّر (:values)',
    'required_with_all' => 'الحقل (:attribute) إذا توفّر (:values)',
    'required_without' => 'الحقل (:attribute) مطلوب إذا لم يتوفّر الحقل (:values)',
    'required_without_all' => 'الحقل (:attribute) إذا لم يتوفّر (:values)',
    'same' => 'يجب أن يتطابق الحقل (:attribute) مع (:other)',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل (:attribute) على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف (:attribute) :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل (:attribute) مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص (:attribute) على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'الحقل (:attribute) يجب ان يبدأ بأحد القيم التالية: (:values)',
    'string' => 'يجب أن يكون الحقل (:attribute) نصآ',
    'timezone' => 'يجب أن يكون (:attribute) نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل (:attribute) مُستخدمة من قبل',
    'uniqueF' => '(:attribute) موجودة مسبقاً',
    'uploaded' => 'فشل في تحميل الـ (:attribute)',
    'url' => 'صيغة الرابط (:attribute) غير صحيحة',
    'uuid' => 'الحقل (:attribute) يجب ان ايكون رقم UUID صحيح',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
		'name'              =>  '',
		'email'             =>  '',
		'password'          =>  '',
		'user_name'         =>  '',
		'role'              =>  '',
		'balance'           =>  '',
		'goverment'         =>  '',
		'city'              =>  '',
		'area'              =>  '',
		'street'            =>  '',
		'user_id'           =>  '',
		'image'             =>  '',
		'description'       =>  '',
		'status'            =>  '',
		'place_id'          =>  '',
		'price'             =>  '',
		'text'              =>  '',
		'address_id'        =>  '',
		'owner_id'          =>  '',
		'maximum_capacity'  =>  '',
		'price_per_hour'    =>  '',
		'date_of_add'       =>  '',
		'space'             =>  '',
		'rate'              =>  '',
		'license'           =>  '',
		'category_id'       =>  '',
		'type_id'           =>  '',
		'total_price'       =>  '',
		'date_and_time'     =>  '',
		'value'             =>  '',
		'date'              =>  '',
		'day'               =>  '',
		'from_time'         =>  '',
		'to_time'           =>  '',
		'is_Active'         =>  '',
		'reservation_id'    =>  '',
		'extension_id'      =>  '',
		'token'             =>  '',
	],

];