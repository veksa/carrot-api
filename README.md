# PHP Carrot Quest Api

[![Stable Version](https://poser.pugx.org/veksa/carrot-api/v/stable)](https://packagist.org/packages/veksa/carrot-api)
[![License](https://poser.pugx.org/veksa/carrot-api/license)](https://packagist.org/packages/veksa/carrot-api)
[![Total Downloads](https://poser.pugx.org/veksa/carrot-api/downloads)](https://packagist.org/packages/veksa/carrot-api)
[![Daily Downloads](https://poser.pugx.org/veksa/carrot-api/d/daily)](https://packagist.org/packages/veksa/carrot-api)
[![Build Status](https://travis-ci.org/veksa/carrot-api.svg)](https://travis-ci.org/veksa/carrot-api)
[![Code Climate](https://codeclimate.com/github/veksa/carrot-api/badges/gpa.svg)](https://codeclimate.com/github/veksa/carrot-api)
[![Test Coverage](https://codeclimate.com/github/veksa/carrot-api/badges/coverage.svg)](https://codeclimate.com/github/veksa/carrot-api/coverage)

An extended native php wrapper for [Carrot Quest API](https://carrotquest.io/developers/endpoints/) without requirements. Supports all methods and types of responses.

##Install
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require  veksa/carrot-api "~1.0"
```

or add

```
"veksa/carrot-api": "~1.0"
```

to the require section of your `composer.json` file.

## Usage

### API Wrapper
``` php
$carrot = new \Veksa\Carrot\Api('YOUR_APP_ID', 'YOUR_CARROT_API_TOKEN');
```
### Methods

#### getActiveUsers
Get the users who are currently online on the status of "online".

----------

#### getCountLeads
Get count of users (leads). User if the lead is considered to be, if known contacts about it: name, email, phone, User ID, or it was at least one dialogue.

----------

#### getLeads
Get all users (leads). User if the lead is considered to be, if known contacts about it: name, email, phone, User ID, or it was at least one dialogue.

**filters** *array*: array of filters, examples: https://carrotquest.io/developers/filters/.

**prop** *string*: property for sort. Default: $last_seen

**order** *string*: sort order. Default: desc

**limit** *int*: limit show users. Default: 20

**offset** *int*: start from. Default: 0

----------

#### getConversations
Get all the dialogues of application.

**id** *int*: user ID.

**limit** *int*: limit show dialogues. Default: 20

**offset** *int*: start from. Default: 0

**closed** *bool|null*: true - open dialogues, false - closed dialogues, null - all dialogues

**assigned** *int|null*: Id of Admin that dialogues is assign, or null

**tags** *array*: array of tags

----------

#### getConversation
Get information about the specific dialog.

**id** *int*: dialogue ID. *Required options*

----------

#### getMessages
Get messages in a specific dialog.

**id** *int*: dialogue ID. *Required options*

**limit** *int*: limit show users. Default: 20

**offset** *int*: start from. Default: 0

----------

#### sendConversationMessage
Send messages to a specific dialog.

**id** *int*: dialogue ID. *Required options*

**message** *string*: text of message. *Required options*

**type** *string*: type of message. Default: note

**botName** *string*: name of bot. Default: Bot

**fromUser** *bool*: true - message from user

**fromAdmin** *int*: Id of Admin or default_admin to send message from admin

**randomId** *int*: random Id of message, for control delivery. Default: 0

**autoAssign** *int*: Id of Admin than auto assign to him

**autoAssignRandomId** *int*: random Id of message, for control assign delivery. Default: 0

----------

#### readMessages
Mark all messages as read in the dialogue (by the user on the site).

**id** *int*: dialogue ID. *Required options*

----------

#### setTyping
Set typing message in conversation.

**id** *int*: dialogue ID. *Required options*

**message** *string*: message.

**botName** *string*: set typing botName

**fromUser** *bool*: set typing from user

**fromAdmin** *int*: set typing from admin

----------

#### assignConversation
Assign a specific dialogue defined by the administrator (or removes the assignment).

**id** *int*: dialogue ID. *Required options*

**adminId** *int|null*: admin ID or null to remove assignment.

**fromAdminId** *int|null*: admin ID from assignment

**botName** *string*: bot name from assignment. Default: Bot

**randomId** *int*: number for control assignment

----------

#### addTag
Add tag to dialogue.

**id** *int*: dialogue ID. *Required options*

**tag** *string*: tag.

**fromAdminId** *int|null*: admin ID from assignment

**botName** *string*: bot name from assignment. Default: Bot

**randomId** *int*: number for control assignment

----------

#### deleteTag
Delete tag from dialogue.

**id** *int*: dialogue ID. *Required options*

**tag** *string*: tag.

**fromAdminId** *int|null*: admin ID from assignment

**botName** *string*: bot name from assignment. Default: Bot

**randomId** *int*: number for control assignment

----------

#### closeConversation
Close the conversation.

**id** *int*: dialogue ID. *Required options*

**fromAdminId** *int|null*: admin ID from assignment

**botName** *string*: bot name from assignment. Default: Bot

**randomId** *int*: number for control assignment

----------

#### getUser
Get user by ID.

**id** *int*: user ID. *Required options*

**isSystem** *bool*: system or local ID. Default is system

----------

#### setProps
Add or Update user props.

**id** *int*: user ID. *Required options*

**props** *array*: array of props. *Required options*

**isSystem** *bool*: is system ID?

----------

#### deleteProps
Delete user props.

**id** *int*: user ID. *Required options*

**props** *array*: array of props. *Required options*

**isSystem** *bool*: is system ID?

----------

#### setPresence
Set user status.

**id** *int*: user ID. *Required options*

**presence** *string*: user status. *Required options*

**sessionId** *string*: session ID *Required options*

----------

#### sendUserMessage
Send messages to a specific user.

**id** *int*: user ID. *Required options*

**message** *string*: text of message. *Required options*

**type** *string*: is note or message. Default: popup_chat

----------

#### startConversation
Start conversation with user.

**id** *int*: user ID. *Required options*

**message** *string*: text of message. *Required options*

----------

#### trackEvent
Tracking events, which is performed by the user.

**id** *int*: user ID. *Required options*

**eventName** *string*: name of event. *Required options*

**additionalParams** *array*: additional params

----------

#### getEvents
Receive events that the user makes a chronologically.

**id** *int*: user ID. *Required options*

**eventName** *string*: name of event to filter.

**limit** *int*: limit show users. Default: 20

**offset** *int*: start from. Default: 0

----------

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email admin@devblog.pro instead of using the issue tracker.

## Credits

- [Alex Khijnij](https://github.com/veksa)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
