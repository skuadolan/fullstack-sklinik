<?php

namespace App\Traits;

trait HttpCode
{
    // 1xx Informational
    protected const CONTINUE = 100;

    protected const SWITCHING_PROTOCOLS = 101;

    protected const PROCESSING = 102;

    protected const EARLY_HINTS = 103;

    // 2xx Success
    protected const OK = 200;

    protected const CREATED = 201;

    protected const ACCEPTED = 202;

    protected const NON_AUTHORITATIVE_INFORMATION = 203;

    protected const NO_CONTENT = 204;

    protected const RESET_CONTENT = 205;

    protected const PARTIAL_CONTENT = 206;

    protected const MULTI_STATUS = 207;

    protected const ALREADY_REPORTED = 208;

    protected const IM_USED = 226;

    // 3xx Redirection
    protected const MULTIPLE_CHOICES = 300;

    protected const MOVED_PERMANENTLY = 301;

    protected const FOUND = 302;

    protected const SEE_OTHER = 303;

    protected const NOT_MODIFIED = 304;

    protected const USE_PROXY = 305;

    protected const SWITCH_PROXY = 306;

    protected const TEMPORARY_REDIRECT = 307;

    protected const PERMANENT_REDIRECT = 308;

    // 4xx Client Error
    protected const BAD_REQUEST = 400;

    protected const UNAUTHORIZED = 401;

    protected const PAYMENT_REQUIRED = 402;

    protected const FORBIDDEN = 403;

    protected const NOT_FOUND = 404;

    protected const METHOD_NOT_ALLOWED = 405;

    protected const NOT_ACCEPTABLE = 406;

    protected const PROXY_AUTHENTICATION_REQUIRED = 407;

    protected const REQUEST_TIMEOUT = 408;

    protected const CONFLICT = 409;

    protected const GONE = 410;

    protected const LENGTH_REQUIRED = 411;

    protected const PRECONDITION_FAILED = 412;

    protected const PAYLOAD_TOO_LARGE = 413;

    protected const URI_TOO_LONG = 414;

    protected const UNSUPPORTED_MEDIA_TYPE = 415;

    protected const RANGE_NOT_SATISFIABLE = 416;

    protected const EXPECTATION_FAILED = 417;

    protected const I_AM_A_TEAPOT = 418;

    protected const MISDIRECTED_REQUEST = 421;

    protected const UNPROCESSABLE_ENTITY = 422;

    protected const LOCKED = 423;

    protected const FAILED_DEPENDENCY = 424;

    protected const TOO_EARLY = 425;

    protected const UPGRADE_REQUIRED = 426;

    protected const PRECONDITION_REQUIRED = 428;

    protected const TOO_MANY_REQUESTS = 429;

    protected const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;

    protected const UNAVAILABLE_FOR_LEGAL_REASONS = 451;

    // 5xx Server Error
    protected const INTERNAL_SERVER_ERROR = 500;

    protected const NOT_IMPLEMENTED = 501;

    protected const BAD_GATEWAY = 502;

    protected const SERVICE_UNAVAILABLE = 503;

    protected const GATEWAY_TIMEOUT = 504;

    protected const HTTP_VERSION_NOT_SUPPORTED = 505;

    protected const VARIANT_ALSO_NEGOTIATES = 506;

    protected const INSUFFICIENT_STORAGE = 507;

    protected const LOOP_DETECTED = 508;

    protected const BANDWIDTH_LIMIT_EXCEEDED = 509;

    protected const NOT_EXTENDED = 510;

    protected const NETWORK_AUTHENTICATION_REQUIRED = 511;

    protected const HTTP_MSG = [
        // 1xx Informational
        self::CONTINUE => 'Continue',
        self::SWITCHING_PROTOCOLS => 'Switching Protocols',
        self::PROCESSING => 'Processing',
        self::EARLY_HINTS => 'Early Hints',

        // 2xx Success
        self::OK => 'OK',
        self::CREATED => 'Created',
        self::ACCEPTED => 'Accepted',
        self::NON_AUTHORITATIVE_INFORMATION => 'Non-Authoritative Information',
        self::NO_CONTENT => 'No Content',
        self::RESET_CONTENT => 'Reset Content',
        self::PARTIAL_CONTENT => 'Partial Content',
        self::MULTI_STATUS => 'Multi-Status',
        self::ALREADY_REPORTED => 'Already Reported',
        self::IM_USED => 'IM Used',

        // 3xx Redirection
        self::MULTIPLE_CHOICES => 'Multiple Choices',
        self::MOVED_PERMANENTLY => 'Moved Permanently',
        self::FOUND => 'Found',
        self::SEE_OTHER => 'See Other',
        self::NOT_MODIFIED => 'Not Modified',
        self::USE_PROXY => 'Use Proxy',
        self::SWITCH_PROXY => 'Switch Proxy',
        self::TEMPORARY_REDIRECT => 'Temporary Redirect',
        self::PERMANENT_REDIRECT => 'Permanent Redirect',

        // 4xx Client Error
        self::BAD_REQUEST => 'Bad Request',
        self::UNAUTHORIZED => 'Unauthorized',
        self::PAYMENT_REQUIRED => 'Payment Required',
        self::FORBIDDEN => 'Forbidden',
        self::NOT_FOUND => 'Not Found',
        self::METHOD_NOT_ALLOWED => 'Method Not Allowed',
        self::NOT_ACCEPTABLE => 'Not Acceptable',
        self::PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
        self::REQUEST_TIMEOUT => 'Request Timeout',
        self::CONFLICT => 'Conflict',
        self::GONE => 'Gone',
        self::LENGTH_REQUIRED => 'Length Required',
        self::PRECONDITION_FAILED => 'Precondition Failed',
        self::PAYLOAD_TOO_LARGE => 'Payload Too Large',
        self::URI_TOO_LONG => 'URI Too Long',
        self::UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
        self::RANGE_NOT_SATISFIABLE => 'Range Not Satisfiable',
        self::EXPECTATION_FAILED => 'Expectation Failed',
        self::I_AM_A_TEAPOT => 'I am a teapot',
        self::MISDIRECTED_REQUEST => 'Misdirected Request',
        self::UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        self::LOCKED => 'Locked',
        self::FAILED_DEPENDENCY => 'Failed Dependency',
        self::TOO_EARLY => 'Too Early',
        self::UPGRADE_REQUIRED => 'Upgrade Required',
        self::PRECONDITION_REQUIRED => 'Precondition Required',
        self::TOO_MANY_REQUESTS => 'Too Many Requests',
        self::REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
        self::UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable For Legal Reasons',

        // 5xx Server Error
        self::INTERNAL_SERVER_ERROR => 'Internal Server Error',
        self::NOT_IMPLEMENTED => 'Not Implemented',
        self::BAD_GATEWAY => 'Bad Gateway',
        self::SERVICE_UNAVAILABLE => 'Service Unavailable',
        self::GATEWAY_TIMEOUT => 'Gateway Timeout',
        self::HTTP_VERSION_NOT_SUPPORTED => 'HTTP Version Not Supported',
        self::VARIANT_ALSO_NEGOTIATES => 'Variant Also Negotiates',
        self::INSUFFICIENT_STORAGE => 'Insufficient Storage',
        self::LOOP_DETECTED => 'Loop Detected',
        self::BANDWIDTH_LIMIT_EXCEEDED => 'Bandwidth Limit Exceeded',
        self::NOT_EXTENDED => 'Not Extended',
        self::NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
    ];
}
