<?php

declare(strict_types=1);

return [
    'accepted' => 'O :attribute debe ser aceptado.',
    'accepted_if' => 'O :attribute debe ser aceptado cando :other é :value.',
    'active_url' => 'O :attribute non é unha URL válida.',
    'after' => 'O :attribute debe ser unha data despois de :date.',
    'after_or_equal' => 'O :attribute debe ser unha data posterior ou igual a :date.',
    'alpha' => 'O :attribute só debe conter letras.',
    'alpha_dash' => 'O :attribute só debe conter letras, números, guións e guións baixos.',
    'alpha_num' => 'O :attribute só debe conter letras e números.',
    'array' => 'O :attribute debe ser un array.',
    'before' => 'O :attribute debe ser unha data anterior a :date.',
    'before_or_equal' => 'O :attribute debe ser unha data anterior ou igual a :date.',
    'between' => [
        'array' => 'O :attribute debe estar entre :min e :max items.',
        'file' => 'O :attribute debe estar entre :min e :max kilobytes.',
        'numeric' => 'O :attribute debe estar entre :min e :max.',
        'string' => 'O :attribute debe estar entre :min e :max caracteres.',
    ],
    'boolean' => 'O :attribute campo debe ser verdadeiro ou falso.',
    'confirmed' => 'A :attribute a confirmación non coincide.',
    'current_password' => 'O contrasinal é incorrecto.',
    'date' => 'O :attribute non é unha data válida.',
    'date_equals' => 'O :attribute debe ser unha data igual a :date.',
    'date_format' => 'O :attribute non coincide co formato :format.',
    'declined' => 'O :attribute debe ser rexeitado.',
    'declined_if' => 'O :attribute debe ser rexeitado cando :other é :value.',
    'different' => 'O :attribute e :other debe ser diferente.',
    'digits' => 'O :attribute debe ser :digits díxitos.',
    'digits_between' => 'O :attribute debe estar entre :min e :max díxitos.',
    'dimensions' => 'O :attribute ten dimensións de imaxe non válidas.',
    'distinct' => 'O eido :attribute ten un valor duplicado.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => 'O :attribute debe ser un enderezo de correo-e válido.',
    'ends_with' => 'O :attribute debe rematar cun dos seguintes: :values.',
    'enum' => 'O :attribute seleccionado non é válido.',
    'exists' => 'O :attribute seleccionado non é válido.',
    'file' => 'O :attribute debe ser un arquivo.',
    'filled' => 'O eido :attribute debe ter un valor.',
    'gt' => [
        'array' => 'O :attribute debe ter máis de :value items.',
        'file' => 'O :attribute debe ser maior que :value kilobytes.',
        'numeric' => 'O :attribute debe ser maior que :value.',
        'string' => 'O :attribute debe ser maior que :value caracteres.',
    ],
    'gte' => [
        'array' => 'O :attribute debe ter :value items ou máis.',
        'file' => 'O :attribute debe ser maior ou igual a :value kilobytes.',
        'numeric' => 'O :attribute debe ser maior ou igual a :value.',
        'string' => 'O :attribute debe ser maior ou igual a :value caracteres.',
    ],
    'image' => 'O :attribute debe ser unha imaxe.',
    'in' => 'O :attribute seleccionado non é válido.',
    'in_array' => 'O eido :attribute non existe en :other.',
    'integer' => 'O :attribute debe ser un integro.',
    'ip' => 'O :attribute debe ser unha dirección IP válida.',
    'ipv4' => 'O :attribute debe ser unha dirección IPv4 válida.',
    'ipv6' => 'O :attribute debe ser unha dirección IPv6 válida.',
    'json' => 'O :attribute debe ser unha cadea JSON válida.',
    'lt' => [
        'array' => 'O :attribute debe ter menos de :value items.',
        'file' => 'O :attribute debe ser inferior a :value kilobytes.',
        'numeric' => 'O :attribute debe ser menos que :value.',
        'string' => 'O :attribute debe ser inferior a :value caracteres.',
    ],
    'lte' => [
        'array' => 'O :attribute non debe ter máis de :value items.',
        'file' => 'O :attribute debe ser inferior ou igual a :value kilobytes.',
        'numeric' => 'O :attribute debe ser inferior ou igual a :value.',
        'string' => 'O :attribute debe ser inferior ou igual a :value caracteres.',
    ],
    'mac_address' => 'O :attribute debe ser unha dirección MAC válida.',
    'max' => [
        'array' => 'O :attribute non debe ter máis de :max items.',
        'file' => 'O :attribute non debe ser maior que :max kilobytes.',
        'numeric' => 'O :attribute non debe ser maior que :max.',
        'string' => 'O :attribute non debe ser maior que :max caracteres.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => 'O :attribute debe ser un arquivo de tipo: :values.',
    'mimetypes' => 'O :attribute debe ser un arquivo de tipo: :values.',
    'min' => [
        'array' => 'O :attribute debe ter polo menos :min items.',
        'file' => 'O :attribute debe ser polo menos :min kilobytes.',
        'numeric' => 'O :attribute debe ser polo menos :min.',
        'string' => 'O :attribute deben ser polo menos :min caracteres.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => 'O :attribute debe ser un múltiplo de :value.',
    'not_in' => 'O :attribute seleccionado non é válido.',
    'not_regex' => 'O formato de :attribute non é válido.',
    'numeric' => 'O :attribute debe ser un número.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'O eido :attribute debe estar presente.',
    'prohibited' => 'O eido :attribute está prohibido.',
    'prohibited_if' => 'O eido :attribute está prohibido cando :other é :value.',
    'prohibited_unless' => 'O eido :attribute está prohibido a non ser que :other sexa :values.',
    'prohibits' => 'O eido :attribute prohibe que estea presente :other.',
    'regex' => 'O formato :attribute non é válido.',
    'required' => 'O eido :attribute é obrigatorio.',
    'required_array_keys' => 'O eido :attribute debe conter entradas para: :values.',
    'required_if' => 'O eido :attribute é requirido cando :other é :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'O eido :attribute é requirido a non ser que :other sexa :values.',
    'required_with' => 'O eido :attribute é requirido cando :values está presente.',
    'required_with_all' => 'O eido :attribute é requirido cando :values están presentes.',
    'required_without' => 'O eido :attribute é requirido cando :values non está presente.',
    'required_without_all' => 'O eido :attribute é requirido cando ningún dos :values están presentes.',
    'same' => 'O :attribute e o :other deben coincidir.',
    'size' => [
        'array' => 'O :attribute debe conter :size items.',
        'file' => 'O :attribute debe ser :size kilobytes.',
        'numeric' => 'O :attribute debe ser :size.',
        'string' => 'O :attribute debe ser :size caracteres.',
    ],
    'starts_with' => 'O :attribute debe comezar por un dos seguintes: :values.',
    'string' => 'O :attribute debe ser unha cadea - string.',
    'timezone' => 'O :attribute debe ser un fuso horario válido.',
    'unique' => 'O :attribute xa está collido.',
    'uploaded' => 'O :attribute fallou ao cargar.',
    'url' => 'O :attribute debe ser unha URL válida.',
    'uuid' => 'O :attribute debe ser un UUID válido.',
    'attributes' => [
        'address' => 'dirección',
        'age' => 'idade',
        'amount' => 'cantidade',
        'area' => 'área',
        'available' => 'dispoñible',
        'birthday' => 'aniversario',
        'body' => 'corpo',
        'city' => 'cidade',
        'content' => 'contido',
        'country' => 'país',
        'created_at' => 'creado o',
        'creator' => 'creador',
        'current_password' => 'contrasinal actual',
        'date' => 'data',
        'date_of_birth' => 'data de nacemento',
        'day' => 'día',
        'deleted_at' => 'eliminado o',
        'description' => 'descrición',
        'district' => 'distrito',
        'duration' => 'duración',
        'email' => 'email',
        'excerpt' => 'extracto',
        'filter' => 'filtro',
        'first_name' => 'nome',
        'gender' => 'xénero',
        'group' => 'grupo',
        'hour' => 'hora',
        'image' => 'imaxe',
        'last_name' => 'apelido',
        'lesson' => 'lección',
        'line_address_1' => 'enderezo liña 1',
        'line_address_2' => 'enderezo liña 2',
        'message' => 'mensaxe',
        'middle_name' => 'segundo nome',
        'minute' => 'minuto',
        'mobile' => 'móbil',
        'month' => 'mes',
        'name' => 'nome',
        'national_code' => 'código nacional',
        'number' => 'número',
        'password' => 'contrasinal',
        'password_confirmation' => 'confirmar contrasinal',
        'phone' => 'teléfono',
        'photo' => 'foto',
        'postal_code' => 'código postal',
        'price' => 'prezo',
        'province' => 'provincia',
        'recaptcha_response_field' => 'eido de resposta recaptcha',
        'remember' => 'lembar',
        'restored_at' => 'restaurado ás',
        'result_text_under_image' => 'texto do resultado baixo a imaxe',
        'role' => 'rol',
        'second' => 'segundo',
        'sex' => 'sexo',
        'short_text' => 'texto corto',
        'size' => 'tamaño',
        'state' => 'estado',
        'street' => 'rúa',
        'student' => 'estudante',
        'subject' => 'asunto',
        'teacher' => 'titor',
        'terms' => 'términos',
        'test_description' => 'probar descrición',
        'test_locale' => 'probar local',
        'test_name' => 'probar nome',
        'text' => 'texto',
        'time' => 'tempo',
        'title' => 'título',
        'updated_at' => 'actualizado ás',
        'username' => 'nome do usuario',
        'year' => 'ano',
    ],
];