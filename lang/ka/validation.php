<?php

declare(strict_types=1);

return [
    'accepted' => ':Attribute უნდა იყოს მონიშნული.',
    'accepted_if' => 'ველი :attribute უნდა იყოს მიღებული, როცა :other შეესაბამება :value.',
    'active_url' => ':Attribute არ არის სწორი ბმული.',
    'after' => ':Attribute უნდა იყოს თარიღი :date-ის შემდეგ.',
    'after_or_equal' => ':Attribute უნდა იყოს თარიღი :date-ის შემდეგ ან მისი ტოლი.',
    'alpha' => ':Attribute უნდა შეიცავდეს მხოლოდ ასოებს.',
    'alpha_dash' => ':Attribute უნდა შეიცავდეს მხოლოდ ასოებს, რიცხვებს, ტირეებს და ქვეტირეებს.',
    'alpha_num' => ':Attribute უნდა შეიცავდეს მხოლოდ ასოებს და რიცხვებს.',
    'array' => ':Attribute უნდა იყოს მასივი.',
    'before' => ':Attribute უნდა იყოს თარიღი :date-მდე.',
    'before_or_equal' => ':Attribute უნდა იყოს თარიღი :date-მდე ან მისი ტოლი.',
    'between' => [
        'array' => ':Attribute-ის რაოდენობა უნდა იყოს :min-დან :max-მდე.',
        'file' => ':Attribute უნდა იყოს :min-სა და :max კილობაიტს შორის.',
        'numeric' => ':Attribute უნდა იყოს :min-სა და :max-ს შორის.',
        'string' => ':Attribute უნდა იყოს :min-სა და :max სიმბოლოს შორის.',
    ],
    'boolean' => ':Attribute ველი უნდა იყოს true ან false.',
    'confirmed' => ':Attribute-ის დადასტურება არ ემთხვევა.',
    'current_password' => 'ველი :attribute შეიცავს არასწორ პაროლს.',
    'date' => ':Attribute შეიცავს თარიღის არასწორ ფორმატს.',
    'date_equals' => ':Attribute უნდა იყოს :date-ის ტოლი თარიღი.',
    'date_format' => ':Attribute არ ემთხვევა თარიღის ფორმატს: :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => ':Attribute და :other არ უნდა ემთხვეოდეს ერთმანეთს.',
    'digits' => ':Attribute უნდა შედგებოდეს :digits ციფრისგან.',
    'digits_between' => ':Attribute უნდა შედგებოდეს :min-დან :max ციფრამდე.',
    'dimensions' => ':Attribute შეიცავს სურათის არასწორ ზომებს.',
    'distinct' => ':Attribute-ის ველს აქვს დუბლირებული მნიშვნელობა.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => ':Attribute უნდა იყოს სწორი ელ.ფოსტა.',
    'ends_with' => ':Attribute უნდა ბოლოვდებოდეს შემდეგიდან ერთ-ერთით: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'არჩეული :attribute არასწორია.',
    'file' => ':Attribute უნდა იყოს ფაილი.',
    'filled' => ':Attribute აუცილებელია.',
    'gt' => [
        'array' => ':Attribute უნდა შეიცავდეს :value ელემენტზე მეტს.',
        'file' => ':Attribute უნდა იყოს :value კილობაიტზე მეტი.',
        'numeric' => ':Attribute უნდა იყოს :value-ზე მეტი.',
        'string' => ':Attribute უნდა შეიცავდეს :value სიმბოლოზე მეტს.',
    ],
    'gte' => [
        'array' => ':Attribute უნდა შეიცავდეს მინიმუმ :value ელემენტს.',
        'file' => ':Attribute უნდა იყოს მინიმუმ :value კილობაიტი.',
        'numeric' => ':Attribute უნდა იყოს მინიმუმ :value.',
        'string' => ':Attribute უნდა შეიცავდეს მინიმუმ :value სიმბოლოს.',
    ],
    'image' => ':Attribute უნდა იყოს სურათი.',
    'in' => 'არჩეული :attribute არასწორია.',
    'in_array' => ':Attribute ველი არ არსებობს :other-ში.',
    'integer' => ':Attribute უნდა იყოს მთელი რიცხვი.',
    'ip' => ':Attribute უნდა იყოს ვალიდური IP მისამართი.',
    'ipv4' => ':Attribute უნდა იყოს ვალიდური IPv4 მისამართი.',
    'ipv6' => ':Attribute უნდა იყოს ვალიდური IPv6 მისამართი.',
    'json' => ':Attribute უნდა იყოს სწორი JSON ტიპის.',
    'lt' => [
        'array' => ':Attribute უნდა შეიცავდეს :value ელემენტზე ნაკლებს.',
        'file' => ':Attribute უნდა იყოს :value კილობაიტზე ნაკლები.',
        'numeric' => ':Attribute უნდა იყოს :value-ზე ნაკლები.',
        'string' => ':Attribute უნდა შეიცავდეს :value სიმბოლოზე ნაკლებს.',
    ],
    'lte' => [
        'array' => ':Attribute უნდა შეიცავდეს მაქსიმუმ :value ელემენტს.',
        'file' => ':Attribute უნდა იყოს მაქსიმუმ :value კილობაიტი.',
        'numeric' => ':Attribute უნდა იყოს მაქსიმუმ :value.',
        'string' => ':Attribute უნდა შეიცავდეს მაქსიმუმ :value სიმბოლოს.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => ':Attribute-ს არ უნდა ჰქონდეს :max ელემენტზე მეტი.',
        'file' => ':Attribute არ უნდა აღემატებოდეს :max კილობაიტს.',
        'numeric' => ':Attribute არ უნდა აღემატებოდეს :max-ს.',
        'string' => ':Attribute არ უნდა აღემატებოდეს :max სიმბოლოს.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => ':Attribute უნდა იყოს შემდეგი ფაილური ტიპის: :values.',
    'mimetypes' => ':Attribute უნდა იყოს შემდეგი ფაილური ტიპის: :values.',
    'min' => [
        'array' => ':Attribute-ს უნდა ჰქონდეს მინიმუმ :min ელემენტი.',
        'file' => ':Attribute უნდა იყოს მინიმუმ :min კილობაიტი.',
        'numeric' => ':Attribute უნდა იყოს მინიმუმ :min.',
        'string' => ':Attribute უნდა შეიცავდეს მინიმუმ :min სიმბოლოს.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => ':Attribute უნდა იყოს :value-ს ჯერადი',
    'not_in' => 'არჩეული :attribute არასწორია.',
    'not_regex' => ':Attribute-ის ფორმატი არასწორია.',
    'numeric' => ':Attribute უნდა იყოს რიცხვი.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => ':Attribute-ის ველი უნდა არსებობდეს, თუნდაც ცარიელი.',
    'prohibited' => ':Attribute სფეროში აკრძალულია.',
    'prohibited_if' => ':Attribute სფეროში აკრძალულია, როდესაც :other არის :value.',
    'prohibited_unless' => ':Attribute სფეროში აკრძალულია თუ :other არის :values.',
    'prohibits' => ':Attribute ველში არ შეიძლება იყოს :other.',
    'regex' => ':Attribute-ის ფორმატი არასწორია.',
    'required' => ':Attribute-ის ველი აუცილებელია.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => ':Attribute-ის ველი აუცილებელია, თუ :other-ის მნიშვნელობა ემთხვევა :value-ს.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => ':Attribute-ის ველი აუცილებელია, თუ :values არ შეიცავს :other-ს.',
    'required_with' => ':Attribute-ის ველი აუცილებელია, თუ :values მითითებულია.',
    'required_with_all' => ':Attribute-ის ველი აუცილებელია, თუ :values მითითებულია.',
    'required_without' => ':Attribute-ის ველი აუცილებელია, თუ :values არ არის მითითებული.',
    'required_without_all' => ':Attribute-ის ველი აუცილებელია, თუ არცერთი :values არ არის მითითებული.',
    'same' => ':Attribute და :other უნდა ემთხვეოდეს ერთმანეთს.',
    'size' => [
        'array' => ':Attribute უნდა შეიცავდეს :size ელემენტს.',
        'file' => ':Attribute უნდა იყოს :size კილობაიტი.',
        'numeric' => ':Attribute უნდა იყოს :size.',
        'string' => ':Attribute უნდა შედგებოდეს :size სიმბოლოსგან.',
    ],
    'starts_with' => ':Attribute უნდა იწყებოდეს შემდეგიდან ერთ-ერთით: :values.',
    'string' => ':Attribute უნდა იყოს ტექსტი.',
    'timezone' => ':Attribute უნდა იყოს სასაათო სარტყელი.',
    'unique' => 'ასეთი :attribute უკვე არსებობს.',
    'uploaded' => ':Attribute-ის ატვირთვა ვერ მოხერხდა.',
    'url' => ':Attribute-ის ფორმატი არასწორია.',
    'uuid' => ':Attribute უნდა იყოს ვალიდური UUID.',
    'attributes' => [
        'address' => 'address',
        'age' => 'age',
        'amount' => 'amount',
        'area' => 'area',
        'available' => 'available',
        'birthday' => 'birthday',
        'body' => 'body',
        'city' => 'city',
        'content' => 'content',
        'country' => 'country',
        'created_at' => 'created at',
        'creator' => 'creator',
        'current_password' => 'current password',
        'date' => 'date',
        'date_of_birth' => 'date of birth',
        'day' => 'day',
        'deleted_at' => 'deleted at',
        'description' => 'description',
        'district' => 'district',
        'duration' => 'duration',
        'email' => 'email',
        'excerpt' => 'excerpt',
        'filter' => 'filter',
        'first_name' => 'first name',
        'gender' => 'gender',
        'group' => 'group',
        'hour' => 'hour',
        'image' => 'image',
        'last_name' => 'last name',
        'lesson' => 'lesson',
        'line_address_1' => 'line address 1',
        'line_address_2' => 'line address 2',
        'message' => 'message',
        'middle_name' => 'middle name',
        'minute' => 'minute',
        'mobile' => 'mobile',
        'month' => 'month',
        'name' => 'name',
        'national_code' => 'national code',
        'number' => 'number',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'phone' => 'phone',
        'photo' => 'photo',
        'postal_code' => 'postal code',
        'price' => 'price',
        'province' => 'province',
        'recaptcha_response_field' => 'recaptcha response field',
        'remember' => 'remember',
        'restored_at' => 'restored at',
        'result_text_under_image' => 'result text under image',
        'role' => 'role',
        'second' => 'second',
        'sex' => 'sex',
        'short_text' => 'short text',
        'size' => 'size',
        'state' => 'state',
        'street' => 'street',
        'student' => 'student',
        'subject' => 'subject',
        'teacher' => 'teacher',
        'terms' => 'terms',
        'test_description' => 'test description',
        'test_locale' => 'test locale',
        'test_name' => 'test name',
        'text' => 'text',
        'time' => 'time',
        'title' => 'title',
        'updated_at' => 'updated at',
        'username' => 'username',
        'year' => 'year',
    ],
];
