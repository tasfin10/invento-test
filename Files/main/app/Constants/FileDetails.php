<?php

namespace App\Constants;

class FileDetails {
    function fileDetails() {
        $data['logoFavicon'] = [
            'path' => 'assets/universal/images/logoFavicon',
        ];

        $data['favicon'] = [
            'size' => '128x128',
        ];

        $data['adminProfile'] = [
            'path' => 'assets/admin/images/profile',
            'size' => '200x200',
        ];

        return $data;
    }
}
