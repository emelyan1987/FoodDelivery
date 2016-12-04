# Basic Usage

```
<?php

require 'Notification.php';

$obj = new Notification;

// func 1: send mail
$result = $obj->mail( 
	array(
		'smtp' => array(
			'host' => 'smtp.gmail.com',
			'port' => 587,
			'secure' => 'tls',
			//'debug' => 1,
			'auth' => array(
				'username' => 'account@gmail.com',
				'password' => 'password@gmail.com',
			),
		),
		'sender' => array(
			'name' => 'DisplayName',
			'email' => 'account@gmail.com'
		)
	), 
	'Mail Subject', 
	'Mail Content', 
	array( 
		'to' => 'receiver@gmail.com'
	) 
);
if ($result['status'] !== true) {
	echo "[ERROR] EMAIL";
	print_r($result);
}


// func 2: iOS app - Apple Push notification
$result = $obj->apple_push_notification(
	file_get_contents('/path/ios-apn-key'),
	'iOS-Device-APN-Token'
	array(
		// apn payload format
		'aps' => array(
			'alert' => array(
				'title' => $title,
				'body' => $message,
			)
		)
	)
);
if ($result['status'] !== true) {
	echo "[ERROR] APN";
	print_r($result);
}

// func 3: android app - Google Cloud Messaging
$result = $obj->google_cloud_messaging(
	'GCM_API_KEY',
	'Android-Device-GCM-Token',
	array(
		// With your payload format
		'data' => array(
			'title' => 'Hello',
			'message' => 'World'
		)
	)
);
if ($result['status'] !== true) {
	echo "[ERROR] GCM";
	print_r($result);
}

```

# Batch mode

Prepare:

```
sqlite> INSERT INTO notification_sender(os_type,app_id,gcm_api_info) VALUES ('android','MyAndroidAppPackageName','API_KEY');
sqlite> INSERT INTO notification_message(id,title,message,timestamp) VALUES(1,'Hello','World',datetime('now','localtime'));
```

Receivers:

```
sqlite> INSERT INTO notification_pool (mid,os_type,app_id,token_check,token,mode) VALUES (1,'android','MyAndroidAppPackageName','md5("GCM_TOKEN_140-180_BYTES_1")','GCM_TOKEN_140-180_BYTES_1','production');
sqlite> INSERT INTO notification_pool (mid,os_type,app_id,token_check,token,mode) VALUES (1,'android','MyAndroidAppPackageName','md5("GCM_TOKEN_140-180_BYTES_2")','GCM_TOKEN_140-180_BYTES_2','production');
sqlite> INSERT INTO notification_pool (mid,os_type,app_id,token_check,token,mode) VALUES (1,'android','MyAndroidAppPackageName','md5("GCM_TOKEN_140-180_BYTES_3")','GCM_TOKEN_140-180_BYTES_3','production');
sqlite> INSERT INTO notification_pool (mid,os_type,app_id,token_check,token,mode) VALUES (1,'android','MyAndroidAppPackageName','md5("GCM_TOKEN_140-180_BYTES_4")','GCM_TOKEN_140-180_BYTES_4','production');
```

Run:

```
<?php
require 'Notification.php';

$obj = new Notification;
$obj->batch_run_via_sqlite3();
```

Result:

```
sqlite> SELECT mid, error, count(*) FROM notification_pool WHERE sendtime IS NOT NULL GROUP BY mid, error
sqlite> SELECT mid, SUM(CASE WHEN error IS NULL THEN 1 ELSE 0 END) AS success, SUM(CASE WHEN error IS NULL THEN 0 ELSE 1 END) AS failure, count(*) AS total FROM notification_pool GROUP BY mid;
```

# CodeIgniter Usage

## Info

CodeIgniter 3.x

## Install

```
$ cd /path/project/application/library
$ git clone --recursive https://github.com/changyy/codeigniter-library-notification
```

## Example

```
<?php
	$this->load->library('codeigniter-library-notification/notification');

	// func 1: send mail
	$this->notification->mail();

	// func 2: iOS app - Apple Push notification
	$this->notification->apple_push_notification();

	// func 3: android app - Google Cloud Messaging
	$this->notification->google_cloud_messaging();

```

# Dependence

- Use PHPMailer v5.2.14 / 1 Nov 2015

https://github.com/PHPMailer/PHPMailer/commit/e774bc9152de85547336e22b8926189e582ece95

```
$ git submodule add https://github.com/PHPMailer/PHPMailer
$ cd PHPMailer
$ git reset --hard e774bc9152de85547336e22b8926189e582ece95
$ cd -
$ git commit -am 'set PHPMailer version to v5.2.14 / https://github.com/PHPMailer/PHPMailer/commit/e774bc9152de85547336e22b8926189e582ece95'
```

# GMail Notes

- Q: SMTP ERROR: Password command failed / SMTP Error: Could not authenticate.

  A: https://www.google.com/settings/security/lesssecureapps

