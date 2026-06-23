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

    'accepted' => ':attribute باید پذیرفته شود.',
    'accepted_if' => ':attribute باید زمانی که :other برابر با :value است پذیرفته شود.',
    'active_url' => ':attribute باید یک URL معتبر باشد.',
    'after' => ':attribute باید یک تاریخ بعد از :date باشد.',
    'after_or_equal' => ':attribute باید یک تاریخ بعد از یا برابر با :date باشد.',
    'alpha' => ':attribute باید فقط شامل حروف باشد.',
    'alpha_dash' => ':attribute باید فقط شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num' => ':attribute باید فقط شامل حروف و اعداد باشد.',
    'array' => ':attribute باید یک آرایه باشد.',
    'ascii' => ':attribute باید فقط شامل کاراکترهای آلفانومریک و نمادهای تک بایتی باشد.',
    'before' => ':attribute باید یک تاریخ قبل از :date باشد.',
    'before_or_equal' => ':attribute باید یک تاریخ قبل از یا برابر با :date باشد.',
    'between' => [
        'array' => ':attribute باید بین :min و :max آیتم داشته باشد.',
        'file' => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'string' => ':attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => ':attribute باید true یا false باشد.',
    'can' => ':attribute حاوی یک مقدار غیرمجاز است.',
    'confirmed' => 'تأیید :attribute با هم مطابقت ندارد.',
    'contains' => ':attribute حاوی یک مقدار الزامی است.',
    'current_password' => 'رمز عبور وارد شده صحیح نیست.',
    'date' => ':attribute باید یک تاریخ معتبر باشد.',
    'date_equals' => ':attribute باید یک تاریخ برابر با :date باشد.',
    'date_format' => ':attribute باید با فرمت تاریخ :format مطابقت داشته باشد.',
    'decimal' => ':attribute باید دارای :decimal رقم اعشاری باشد.',
    'declined' => ':attribute باید رد شود.',
    'declined_if' => ':attribute باید زمانی که :other برابر با :value است رد شود.',
    'different' => ':attribute و :other باید متفاوت باشند.',
    'digits' => ':attribute باید :digits رقم باشد.',
    'digits_between' => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions' => ':attribute ابعاد تصویر صحیح ندارد.',
    'distinct' => ':attribute دارای مقدار تکراری است.',
    'doesnt_end_with' => ':attribute نباید با یکی از مقادیر زیر تمام شود: :values.',
    'doesnt_start_with' => ':attribute نباید با یکی از مقادیر زیر شروع شود: :values.',
    'email' => ':attribute باید یک آدرس ایمیل معتبر باشد.',
    'ends_with' => ':attribute باید با یکی از مقادیر زیر تمام شود: :values.',
    'enum' => 'مقدار انتخاب شده برای :attribute معتبر نیست.',
    'exists' => 'مقدار انتخاب شده برای :attribute معتبر نیست.',
    'extensions' => ':attribute باید یکی از پسوندهای زیر را داشته باشد: :values.',
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => ':attribute باید مقداری داشته باشد.',
    'gt' => [
        'array' => ':attribute باید بیشتر از :value آیتم داشته باشد.',
        'file' => ':attribute باید بیشتر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید بزرگتر از :value باشد.',
        'string' => ':attribute باید بیشتر از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => ':attribute باید حداقل :value آیتم داشته باشد.',
        'file' => ':attribute باید حداقل :value کیلوبایت باشد.',
        'numeric' => ':attribute باید بزرگتر یا برابر با :value باشد.',
        'string' => ':attribute باید حداقل :value کاراکتر باشد.',
    ],
    'hex_color' => ':attribute باید یک رنگ هگزادسیمال معتبر باشد.',
    'image' => ':attribute باید یک تصویر باشد.',
    'in' => 'مقدار انتخاب شده برای :attribute معتبر نیست.',
    'in_array' => ':attribute باید در :other وجود داشته باشد.',
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'ip' => ':attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => ':attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => ':attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => ':attribute باید یک رشته JSON معتبر باشد.',
    'list' => ':attribute باید یک لیست باشد.',
    'lowercase' => ':attribute باید حروف کوچک باشد.',
    'lt' => [
        'array' => ':attribute باید کمتر از :value آیتم داشته باشد.',
        'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'string' => ':attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => ':attribute باید حداکثر :value آیتم داشته باشد.',
        'file' => ':attribute باید حداکثر :value کیلوبایت باشد.',
        'numeric' => ':attribute باید کمتر یا برابر با :value باشد.',
        'string' => ':attribute باید حداکثر :value کاراکتر باشد.',
    ],
    'mac_address' => ':attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => ':attribute نباید بیشتر از :max آیتم داشته باشد.',
        'file' => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
    ],
    'max_digits' => ':attribute نباید بیشتر از :max رقم داشته باشد.',
    'mimes' => ':attribute باید از نوع فایل‌های :values باشد.',
    'mimetypes' => ':attribute باید از نوع فایل‌های :values باشد.',
    'min' => [
        'array' => ':attribute باید حداقل :min آیتم داشته باشد.',
        'file' => ':attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => ':attribute باید حداقل :min باشد.',
        'string' => ':attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => ':attribute باید حداقل :min رقم داشته باشد.',
    'missing' => ':attribute باید موجود نباشد.',
    'missing_if' => ':attribute باید زمانی که :other برابر با :value باشد موجود نباشد.',
    'missing_unless' => ':attribute باید زمانی که :other برابر با :value نیست موجود نباشد.',
    'missing_with' => ':attribute باید زمانی که :values موجود است موجود نباشد.',
    'missing_with_all' => ':attribute باید زمانی که :values موجود هستند موجود نباشد.',
    'multiple_of' => ':attribute باید ضربی از :value باشد.',
    'not_in' => 'مقدار انتخاب شده برای :attribute معتبر نیست.',
    'not_regex' => 'قالب :attribute معتبر نیست.',
    'numeric' => ':attribute باید یک عدد باشد.',
    'password' => [
        'letters' => ':attribute باید حداقل یک حرف داشته باشد.',
        'mixed' => ':attribute باید حداقل یک حرف بزرگ و یک حرف کوچک داشته باشد.',
        'numbers' => ':attribute باید حداقل یک عدد داشته باشد.',
        'symbols' => ':attribute باید حداقل یک نماد داشته باشد.',
        'uncompromised' => ':attribute وارد شده در یک افشاگری داده‌ها ظاهر شده است. لطفاً یک :attribute جدید انتخاب کنید.',
    ],
    'present' => ':attribute باید حاضر باشد.',
    'present_if' => ':attribute باید زمانی که :other برابر با :value است حاضر باشد.',
    'present_unless' => ':attribute باید زمانی که :other برابر با :value نیست حاضر باشد.',
    'present_with' => ':attribute باید زمانی که :values موجود است حاضر باشد.',
    'present_with_all' => ':attribute باید زمانی که :values موجود هستند حاضر باشد.',
    'prohibited' => ':attribute غیرمجاز است.',
    'prohibited_if' => ':attribute غیرمجاز است زمانی که :other برابر با :value باشد.',
    'prohibited_if_accepted' => ':attribute غیرمجاز است زمانی که :other پذیرفته شده باشد.',
    'prohibited_if_declined' => ':attribute غیرمجاز است زمانی که :other رد شده باشد.',
    'prohibited_unless' => ':attribute غیرمجاز است مگر اینکه :other در :values باشد.',
    'prohibits' => ':attribute اجازه نمی‌دهد :other حضور داشته باشد.',
    'regex' => 'قالب :attribute معتبر نیست.',
    'required' => ':attribute الزامی است.',
    'required_array_keys' => ':attribute باید شامل مقادیر برای: :values باشد.',
    'required_if' => ':attribute الزامی است زمانی که :other برابر با :value باشد.',
    'required_if_accepted' => ':attribute الزامی است زمانی که :other پذیرفته شده باشد.',
    'required_if_declined' => ':attribute الزامی است زمانی که :other رد شده باشد.',
    'required_unless' => ':attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with' => ':attribute الزامی است زمانی که :values موجود است.',
    'required_with_all' => ':attribute الزامی است زمانی که همه :values موجود هستند.',
    'required_without' => ':attribute الزامی است زمانی که :values موجود نیست.',
    'required_without_all' => ':attribute الزامی است زمانی که هیچ‌یک از :values موجود نباشد.',
    'same' => ':attribute باید با :other مطابقت داشته باشد.',
    'size' => [
        'array' => ':attribute باید شامل :size آیتم باشد.',
        'file' => ':attribute باید :size کیلوبایت باشد.',
        'numeric' => ':attribute باید :size باشد.',
        'string' => ':attribute باید :size کاراکتر باشد.',
    ],
    'starts_with' => ':attribute باید با یکی از مقادیر زیر شروع شود: :values.',
    'string' => ':attribute باید یک رشته باشد.',
    'timezone' => ':attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => ':attribute قبلاً انتخاب شده است.',
    'uploaded' => ':attribute بارگذاری نشده است.',
    'uppercase' => ':attribute باید با حروف بزرگ باشد.',
    'url' => ':attribute باید یک URL معتبر باشد.',
    'ulid' => ':attribute باید یک ULID معتبر باشد.',
    'uuid' => ':attribute باید یک UUID معتبر باشد.',

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
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'gym_name' => 'نام باشگاه',
        'phone_number' => 'شماره موبایل',
        'name_fa' => 'نام فارسی',
        'name_en' => 'نام انگلیسی',
        'video' => 'ویدیو',
    ],
];
