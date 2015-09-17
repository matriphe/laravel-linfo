<?php
return [
    // original linfo package
    'source' => [
        'byte_notation' => 1024,
        'dates' => 'U',
        'language' => 'en',
        'icons' => true,
        'theme' => 'default',
        'cpu_usage' => true,

        'show' => [
            'uptime' => true,
            'load' => true,
            'ram' => true,
            'cpu' => true,
            'hostname' => true,
            'distro' => true,
            'kernel' => true,
            'os' => true,
            'hd' => true,
            'mounts' => true,
            'mounts_options' => true,
            'network' => true,
            'process_stats' => true,
            'devices' => true,
            'model' => true,
            'numLoggedIn' => true,
            'virtualization' => true,
            'duplicate_mounts' => true,
            'temps' => true,
            'raid' => true,
            'battery' => true,
            'sound' => true,
            'wifi' => true,
            'services' => true,
        ],

        'hide' => [
            'filesystems' => [
                'tmpfs',
                'ecryptfs',
                'nfsd',
                'rpc_pipefs',
                'usbfs',
                'devpts',
                'fusectl',
                'securityfs',
                'fuse.truecrypt',
            ],
            'storage_devices' => [
                'gvfs-fuse-daemon',
                'none',
            ],
            'mountpoints_regex' => [],
            'fs_mount_options' => [
                'ecryptfs',
            ],
            'sg' => true,
        ],

        'raid' => [
            'gmirror' => false,
            'mdadm' => false,
        ],

        'temps' => [
            'hwmon' => true,
            'hddtemp' => false,
            'mbmon' => false,
            'sensord' => false,
        ],
        'temps_show0rpmfans' => false,

        'hddtemp' => [
            'mode' => 'daemon',
            'address' => [
                'host' => 'localhost',
                'port' => 7634,
            ],
        ],

        'mbmon' => [
            'address' => [
                'host' => 'localhost',
                'port' => 411,
            ],
        ],

        'additional_paths' => [],
        'services' => [
            'pidFiles' => [],
            'executables' => [],
        ],
        'show_errors' => false,
        'timer' => false,
        'compress_content' => true,
        'sudo_apps' => [],
    ],
];

