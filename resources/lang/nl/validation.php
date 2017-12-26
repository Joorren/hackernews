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

    'accepted'             => ':attribute moet geaccepteerd worden.',
    'active_url'           => ':attribute is geen geldige URL.',
    'after'                => ':attribute moet een datum na :date zijn.',
    'after_or_equal'       => ':attribute moet een datum na of gelijk aan :date zijn.',
    'alpha'                => ':attribute mag enkel letters bevatten.',
    'alpha_dash'           => ':attribute mag enkel letters, nummers en strepen bevatten.',
    'alpha_num'            => ':attribute mag enkel letters en nummers bevatten.',
    'array'                => ':attribute moet een reeks zijn.',
    'before'               => ':attribute moet een datum voor :date zijn.',
    'before_or_equal'      => ':attribute moet een datum voor of gelijk aan :date zijn.',
    'between'              => [
        'numeric' => ':attribute moet tussen :min en :max liggen.',
        'file'    => ':attribute moet tussen :min en :max kilobytes zijn.',
        'string'  => ':attribute moet tussen :min en :max tekens bevatten.',
        'array'   => ':attribute moet tussen :min en :max items bevatten.',
    ],
    'boolean'              => ':attribute veld moet true of false zijn.',
    'confirmed'            => ':attribute bevestiging komt niet overeen.',
    'date'                 => ':attribute is geen geldige datum.',
    'date_format'          => ':attribute komt niet overeen met het formaat :format.',
    'different'            => ':attribute en :other moeten verschillend zijn.',
    'digits'               => ':attribute moet :digits cijfers zijn.',
    'digits_between'       => ':attribute moet tussen :min and :max cijfers zijn.',
    'dimensions'           => ':attribute heeft ongeldige afbeelding dimenties.',
    'distinct'             => ':attribute veld heeft een dubbele waarde.',
    'email'                => ':attribute moet een echt email adres zijn.',
    'exists'               => 'Geselecteerd :attribute is ongeldig.',
    'file'                 => ':attribute moet een bestand zijn.',
    'filled'               => ':attribute veld moet een waarde hebben.',
    'image'                => ':attribute moet een afbeelding zijn.',
    'in'                   => 'Geselecteerd :attribute is ongeldig.',
    'in_array'             => ':attribute veld bestaat niet in :other.',
    'integer'              => ':attribute moet een nummer zijn.',
    'ip'                   => ':attribute moet een geldig IP adres zijn.',
    'ipv4'                 => ':attribute moet een geldig IPv4 adres zijn.',
    'ipv6'                 => ':attribute moet een geldig IPv6 adres zijn.',
    'json'                 => ':attribute moet een geldige JSON tekst zijn.',
    'max'                  => [
        'numeric' => ':attribute mag niet groter zijn dan :max.',
        'file'    => ':attribute mag niet groter zijn dan :max kilobytes.',
        'string'  => ':attribute mag niet groter zijn dan :max tekens.',
        'array'   => ':attribute mag niet groter zijn dan :max items.',
    ],
    'mimes'                => ':attribute moet een bestand zijn van type: :values.',
    'mimetypes'            => ':attribute moet een bestand zijn van type: :values.',
    'min'                  => [
        'numeric' => ':attribute moet minstens :min zijn.',
        'file'    => ':attribute moet minstens :min kilobytes zijn.',
        'string'  => ':attribute moet minstens :min tekens zijn.',
        'array'   => ':attribute moet minstens :min items zijn.',
    ],
    'not_in'               => 'Geselecteerd :attribute is ongeldig.',
    'numeric'              => ':attribute moet een nummer zijn.',
    'present'              => ':attribute veld moet aanwezig zijn.',
    'regex'                => ':attribute formaat is ongeldig.',
    'required'             => ':attribute veld is verplicht.',
    'required_if'          => ':attribute veld is verplicht als :other :value is.',
    'required_unless'      => ':attribute veld is verplicht tenzij :other in :values zit.',
    'required_with'        => ':attribute veld is verplicht als :values aanwezig is.',
    'required_with_all'    => ':attribute veld is verplicht als :values aanwezig zijn.',
    'required_without'     => ':attribute veld is verplicht als :values niet aanwezig is.',
    'required_without_all' => ':attribute veld is verplicht als niets van :values aanwezig is.',
    'same'                 => ':attribute en :other moeten gelijk zijn.',
    'size'                 => [
        'numeric' => ':attribute moet :size zijn.',
        'file'    => ':attribute moet :size kilobytes zijn.',
        'string'  => ':attribute moet :size tekens zijn.',
        'array'   => ':attribute moet :size items bevatten.',
    ],
    'string'               => ':attribute moet een tekst zijn.',
    'timezone'             => ':attribute moet een geldige zone zijn.',
    'unique'               => ':attribute is al in gebruik.',
    'uploaded'             => ':attribute mislukt om te uploaden.',
    'url'                  => ':attribute formaat is ongeldig.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
