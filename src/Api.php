<?php
namespace Veksa\Carrot;

use Veksa\Carrot\Exceptions\Exception;
use Veksa\Carrot\Exceptions\HttpException;
use Veksa\Carrot\Exceptions\InvalidJsonException;
use Veksa\Carrot\Exceptions\InvalidArgumentException;
use Veksa\Carrot\Types\Conversation;
use Veksa\Carrot\Types\Message;
use Veksa\Carrot\Types\User;

/**
 * Class Api
 *
 * @package Veksa\Carrot
 */
class Api
{
    /**
     * HTTP codes
     *
     * @var array
     */
    public static $codes = [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)',                      // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];
    /**
     * Default http status code
     */
    const DEFAULT_STATUS_CODE = 200;
    /**
     * Not Modified http status code
     */
    const NOT_MODIFIED_STATUS_CODE = 304;

    /**
     * Url prefix
     */
    const URL_PREFIX = 'https://api.carrotquest.io/v1';

    /**
     * CURL object
     *
     * @var
     */
    protected $curl;

    /**
     * Carrot app id
     *
     * @var string
     */
    protected $appId;

    /**
     * Carrot token
     *
     * @var string
     */
    protected $token;

    /**
     * Check whether return associative array
     *
     * @var bool
     */
    protected $returnArray = true;

    /**
     * Constructor
     *
     * @param string $appId Carrot Quest app ID
     * @param string $key Carrot Quest API key
     * @param string $secret Carrot Quest API secret key
     */
    public function __construct($appId, $key, $secret)
    {
        $this->curl = curl_init();
        $this->appId = $appId;
        $this->token = 'app.' . $key . '.' . $secret;
    }

    /**
     * Set return array
     *
     * @param bool $mode
     *
     * @return $this
     */
    public function setModeObject($mode = true)
    {
        $this->returnArray = !$mode;

        return $this;
    }

    /**
     * Call method
     *
     * @param string $method
     * @param array|null $data
     * @param string $type
     *
     * @return mixed
     *
     * @throws Exception
     * @throws HttpException
     * @throws InvalidJsonException
     */
    public function call($method, array $data = null, $type = 'get')
    {
        $url = self::URL_PREFIX . '/' . $method . '?auth_token=' . $this->token;
        if ($data && $type == 'get') {
            $url .= '&' . implode('&', $data);
        }

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ];
        if ($data && $type == 'post') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $data;
        }
        $response = self::jsonValidate($this->executeCurl($options), $this->returnArray);

        return $response['data'];
    }

    /**
     * curl_exec wrapper for response validation
     *
     * @param array $options
     *
     * @return string
     *
     * @throws HttpException
     */
    protected function executeCurl(array $options)
    {
        curl_setopt_array($this->curl, $options);
        $result = curl_exec($this->curl);
        self::curlValidate($this->curl);

        return $result;
    }

    /**
     * Response validation
     *
     * @param resource $curl
     *
     * @throws HttpException
     */
    public static function curlValidate($curl)
    {
        if (($httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE)) &&
            !in_array($httpCode, [self::DEFAULT_STATUS_CODE, self::NOT_MODIFIED_STATUS_CODE])
        ) {
            throw new HttpException(self::$codes[$httpCode], $httpCode);
        }
    }

    /**
     * JSON validation
     *
     * @param string $jsonString
     * @param boolean $asArray
     *
     * @return object|array
     *
     * @throws InvalidJsonException
     */
    public static function jsonValidate($jsonString, $asArray)
    {
        $json = json_decode($jsonString, $asArray);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg(), json_last_error());
        }
        return $json;
    }

    /**
     * Check correct userId
     *
     * @param int $userId
     *
     * @return bool
     */
    private function isEmptyId($userId)
    {
        return !(int)$userId;
    }

    /**
     * Check correct $props
     *
     * @param array $props
     *
     * @return bool
     */
    private function isEmptyProps($props)
    {
        return !is_array($props) || !$props;
    }

    /**
     * Get all active users in application.
     * User is active, when his status is online.
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getActiveUsers()
    {
        $data = $this->call('apps/' . $this->appId . '/activeusers', [], 'get');

        $array = [];
        foreach ($data as $msg) {
            $array[] = User::fromResponse($msg);
        }

        return $array;
    }

    /**
     * Get count of leads in application.
     * Lead - a user who has known name, email, phone, user_id or it was at least one dialogue.
     *
     * @return int
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getCountLeads()
    {
        $data = $this->call('apps/' . $this->appId . '/users', [], 'get');

        if ($data['total']) {
            return (int)$data['total'];
        }

        return 0;
    }

    /**
     * Get all leads in application.
     * Lead - a user who has known name, email, phone, user_id or it was at least one dialogue.
     *
     * @param array $filters - examples https://carrotquest.io/developers/filters/
     * @param string $prop - sort field
     * @param string $order - sort order
     * @param int $limit - max of users then returned
     * @param int $offset - offset of beginning
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function getLeads($filters = [], $prop = '$last_seen', $order = 'desc', $limit = 20, $offset = 0)
    {
        $params = [
            'filters' => $filters,
            'sort_prop' => $prop,
            'sort_order' => $order,
            'limit' => $limit,
            'offset' => $offset
        ];

        $data = $this->call('apps/' . $this->appId . '/users', $params, 'get');

        $array = [];
        if ($data['users']) {
            foreach ($data['users'] as $msg) {
                $array[] = User::fromResponse($msg);
            }
        }

        return $array;
    }

    /**
     * Get all conversations in application.
     *
     * @param int $userId
     * @param int $limit
     * @param int $offset
     *
     * Only for all conversations
     * @param bool $closed - true for open dialogs, false for closed dialogs, null for all dialogs
     * @param int $assigned - Id of Admin or null
     * @param array $tags
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function getConversations(
        $userId = false,
        $limit = 20,
        $offset = 0,
        $closed = null,
        $assigned = null,
        $tags = []
    )
    {
        $params = [
            'count' => $limit,
            'after' => $offset
        ];

        if ($userId) {
            $data = $this->call('users/' . $this->appId . '/conversations', $params, 'get');
        } else {
            if ($closed !== null) {
                $params['closed'] = (bool)$closed;
            }
            if ($assigned !== null) {
                $params['assigned'] = (int)$assigned;
            }
            if ($tags) {
                $params['tags'] = implode(',', $tags);
            }

            $data = $this->call('apps/' . $this->appId . '/conversations', $params, 'get');
        }

        $array = [];
        if ($data) {
            foreach ($data as $msg) {
                $array[] = Conversation::fromResponse($msg);
            }
        }

        return $array;
    }

    /**
     * Get conversation by id.
     *
     * @param int $id
     *
     * @return Conversation
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getConversation($id)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        return Conversation::fromResponse($this->call('conversations/' . $id, [], 'get'));
    }

    /**
     * Get messages from conversation.
     *
     * @param int $id conversation id
     * @param int $count
     * @param int $offset
     *
     * @return Message
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function getMessages($id, $limit = 20, $offset = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        $params = [
            'count' => $limit,
            'after' => $offset
        ];

        $data = $this->call('conversations/' . $id . '/parts', $params, 'get');

        $array = [];
        if ($data) {
            foreach ($data as $msg) {
                $array[] = Message::fromResponse($msg);
            }
        }

        return $array;
    }

    /**
     * Send message to conversation.
     *
     * @param int $id
     * @param string $message
     * @param bool $type
     * @param string $botName
     * @param bool $fromUser - send message from user
     * @param int $fromAdmin - Id of Admin or default_admin, send message from admin
     * @param int $randomId - random Id of message, for control delivery
     * @param int $autoAssign - Id of Admin than auto assign to him
     * @param int $autoAssignRandomId - random Id of message, for control assign delivery
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function sendConversationMessage(
        $id,
        $message,
        $type = 'note',
        $botName = 'Bot',
        $fromUser = false,
        $fromAdmin = 0,
        $randomId = 0,
        $autoAssign = 0,
        $autoAssignRandomId = 0
    )
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$message) {
            throw new InvalidArgumentException;
        }

        if (!in_array($type, ['note', 'reply_admin'])) {
            throw new InvalidArgumentException;
        }

        $params = [
            'bot_name' => $botName,
            'type' => $type,
            'body' => $message
        ];

        $fromUser = (bool)$fromUser;
        if ($fromUser) {
            $params['from_user'] = $fromUser;
        }

        $fromAdmin = (int)$fromAdmin;
        if ($fromAdmin) {
            $params['from_user'] = $fromAdmin;
        }

        $randomId = (int)$randomId;
        if ($randomId) {
            $params['random_id'] = $randomId;
        }

        $autoAssign = (int)$autoAssign;
        if ($autoAssign) {
            $params['auto_assign'] = $autoAssign;
        }

        $autoAssignRandomId = (int)$autoAssignRandomId;
        if ($autoAssignRandomId) {
            $params['auto_assign_random_id'] = $autoAssignRandomId;
        }

        $res = $this->call('conversations/' . $id . '/reply', $params, 'post');

        if ($res && isset($res['id'])) {
            return true;
        }

        return false;
    }

    /**
     * Read all messages in conversation.
     *
     * @param int $id - conversation ID
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function readMessages($id)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        $res = $this->call('conversations/' . $id . '/markread', [], 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Set typing message in conversation.
     *
     * @param int $id - conversation ID
     * @param string $message
     * @param string $botName
     * @param bool $fromUser
     * @param int $fromAdmin
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function setTyping($id, $message, $botName = null, $fromUser = false, $fromAdmin = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        $params = [
            'body' => $message
        ];

        if ($botName) {
            $params['bot_name'] = $botName;
        }

        $fromUser = (bool)$fromUser;
        if ($fromUser) {
            $params['from_user'] = $fromUser;
        }

        $fromAdmin = (int)$fromAdmin;
        if ($fromAdmin) {
            $params['from_admin'] = $fromAdmin;
        }

        $res = $this->call('conversations/' . $id . '/settyping', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Assign a specific dialogue defined by the administrator (or removes the assignment).
     *
     * @param int $id - conversation ID
     * @param int|null $adminId - admin ID, or null to remove assignment
     * @param int|null - admin from assignment
     * @param string $botName
     * @param int $randomId - number for control delivery
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function assignConversation($id, $adminId, $fromAdminId = null, $botName = 'Bot', $randomId = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if ($this->isEmptyId($adminId)) {
            throw new InvalidArgumentException;
        }

        $params = [
            'admin' => $adminId
        ];

        $fromAdminId = (int)$fromAdminId;
        if ($fromAdminId) {
            $params['from_admin'] = $fromAdminId;
        } else {
            $params['bot_name'] = $botName;
        }

        $randomId = (int)$randomId;
        if ($randomId) {
            $params['random_id'] = $randomId;
        }

        $res = $this->call('conversations/' . $id . '/assign', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Add tag to dialogue.
     *
     * @param int $id - conversation ID
     * @param string $tag
     * @param int|null - admin from assignment
     * @param string $botName
     * @param int $randomId - number for control delivery
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function addTag($id, $tag, $fromAdminId = null, $botName = 'Bot', $randomId = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$tag) {
            throw new InvalidArgumentException;
        }

        $tag = str_replace(',', '', $tag);

        $params = [
            'action' => 'add',
            'tag' => $tag
        ];

        $fromAdminId = (int)$fromAdminId;
        if ($fromAdminId) {
            $params['from_admin'] = $fromAdminId;
        } else {
            $params['bot_name'] = $botName;
        }

        $randomId = (int)$randomId;
        if ($randomId) {
            $params['random_id'] = $randomId;
        }

        $res = $this->call('conversations/' . $id . '/tag', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Delete tag from dialogue.
     *
     * @param int $id - conversation ID
     * @param string $tag
     * @param int|null - admin from assignment
     * @param string $botName
     * @param int $randomId - number for control delivery
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function deleteTag($id, $tag, $fromAdminId = null, $botName = 'Bot', $randomId = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$tag) {
            throw new InvalidArgumentException;
        }

        $tag = str_replace(',', '', $tag);

        $params = [
            'action' => 'delete',
            'tag' => $tag
        ];

        $fromAdminId = (int)$fromAdminId;
        if ($fromAdminId) {
            $params['from_admin'] = $fromAdminId;
        } else {
            $params['bot_name'] = $botName;
        }

        $randomId = (int)$randomId;
        if ($randomId) {
            $params['random_id'] = $randomId;
        }

        $res = $this->call('conversations/' . $id . '/tag', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Close the conversation.
     *
     * @param int $id - conversation ID
     * @param int|null - admin from assignment
     * @param string $botName
     * @param int $randomId - number for control delivery
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */

    public function closeConversation($id, $fromAdminId = null, $botName = 'Bot', $randomId = 0)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        $params = [];

        $fromAdminId = (int)$fromAdminId;
        if ($fromAdminId) {
            $params['from_admin'] = $fromAdminId;
        } else {
            $params['bot_name'] = $botName;
        }

        $randomId = (int)$randomId;
        if ($randomId) {
            $params['random_id'] = $randomId;
        }

        $res = $this->call('conversations/' . $id . '/close', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Get user by ID.
     *
     * @param int $id
     * @param bool $isSystem
     *
     * @return User
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getUser($id, $isSystem = true)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        $params = [
            'by_user_id' => !$isSystem,
            'props' => true,
            'props_events' => false,
            'props_custom' => false,
            'presence_details' => true,
            'events' => false,
            'segments' => false,
            'notes' => false
        ];

        return User::fromResponse($this->call('users/' . $id, $params, 'get'));
    }

    /**
     * Insert/Update user props.
     *
     * @param int $id - user ID
     * @param array $props
     * @param bool $isSystem - is system user
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function setProps($id, $props, $isSystem = true)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if ($this->isEmptyProps($props)) {
            throw new InvalidArgumentException;
        }

        $params = [];
        if (!$isSystem) {
            $params['by_user_id'] = 'true';
        }

        $params['operations'] = [];

        if ($props) {
            foreach ($props as $key => $val) {
                $params['operations'][] = ['op' => 'update_or_create', 'key' => $key, 'value' => $val];
            }
        }

        $params['operations'] = json_encode($params['operations']);

        $this->call('users/' . $id . '/props', $params, 'post');
    }

    /**
     * Delete user props.
     *
     * @param int $id - user ID
     * @param array $props
     * @param bool $isSystem - is system user
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function deleteProps($id, $props, $isSystem = true)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if ($this->isEmptyProps($props)) {
            throw new InvalidArgumentException;
        }

        $params = [];
        if (!$isSystem) {
            $params['by_user_id'] = 'true';
        }

        $params['operations'] = [];

        if ($props) {
            foreach ($props as $key => $val) {
                $params['operations'][] = ['op' => 'delete', 'key' => $key, 'value' => $val];
            }
        }

        $params['operations'] = json_encode($params['operations']);

        $this->call('users/' . $id . '/props', $params, 'post');
    }

    /**
     * Set user status.
     *
     * @param int $id - userId
     * @param string $presence - status
     * @param string $sessionId - session id
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function setPresence($id, $presence, $sessionId)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!in_array($presence, User::getPresences())) {
            throw new InvalidArgumentException;
        }

        if (!$sessionId) {
            throw new InvalidArgumentException;
        }

        $params = [
            'presence' => $presence,
            'session' => $sessionId
        ];

        $this->call('users/' . $id . '/setpresence', $params, 'post');
    }

    /**
     * Send message to conversation.
     *
     * @param int $id
     * @param string $message
     * @param bool $type
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function sendUserMessage($id, $message, $type = 'popup_chat')
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$message) {
            throw new InvalidArgumentException;
        }

        if (!in_array($type, ['popup_chat', 'popup_small', 'popup_big', 'email'])) {
            throw new InvalidArgumentException;
        }

        $params = [
            'body' => $message,
            'type' => $type
        ];
        $res = $this->call('users/' . $id . '/sendmessage', $params, 'post');

        if ($res) {
            return true;
        }

        return false;
    }

    /**
     * Start conversation with user.
     *
     * @param int $id - user ID
     * @param string $message
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function startConversation($id, $message)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$message) {
            throw new InvalidArgumentException;
        }

        $params = [
            'body' => $message
        ];

        $res = $this->call('users/' . $id . '/startconversation', $params, 'get');

        if ($res && isset($res['id'])) {
            return true;
        }

        return false;
    }

    /**
     * Tracking events, which is performed by the user.
     *
     * @param $id - user ID
     * @param $eventName
     * @param array $additionalParams
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function trackEvent($id, $eventName, $additionalParams = [], $isSystem = true)
    {
        if ($this->isEmptyId($id)) {
            throw new InvalidArgumentException;
        }

        if (!$eventName) {
            throw new InvalidArgumentException;
        }

        $params = [
            'event' => $eventName,
            'params' => json_encode($additionalParams)
        ];
        if (!$isSystem) {
            $params['by_user_id'] = 'true';
        }

        $res = $this->call('users/' . $id . '/events', $params, 'post');

        if ($res && isset($res['id'])) {
            return true;
        }

        return false;
    }

    /**
     * Close curl
     */
    public function __destruct()
    {
        $this->curl && curl_close($this->curl);
    }
}
