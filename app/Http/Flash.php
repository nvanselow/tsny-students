<?php


namespace Tsny\Http;


class Flash {

    public function create($title, $message, $level = 'info'){
        return session()->flash('flash_message', [
            'title' => $title,
            'message' => $message,
            'level' => $level
        ]);
    }

    public function message($message, $title = 'Info') {
        return $this->create($title, $message);
    }

    public function success($message, $title = 'Success!') {
        return $this->create($title, $message, 'success');
    }

    public function error($message, $title= "Error!") {
        return $this->create($title, $message, 'error');
    }

}