# TO-DO-app

This console application was created by [Paul Albandoz](https://github.com/powlam), and is my first approach to console applications made using the Laravel ecosystem.

- It is a TO-DO application.
- It allows storing tasks and marking them as done. It also adds functionality to list and clear the tasks.

------

## How it works

I recommend creating an alias (`alias to-do="php [PATH]/to-do"`); much more comfortable.

- `to-do add` asks for the task, stores it, and returns its id
- `to-do` or `to-do check` returns a list of opened to-do's (oldest first)
    - It returns nothing if there is no task pending
- `to-do done {Id}` the to-do is marked as done
- `to-do done:all` all the opened to-do's are marked as done
- `to-do history` lists every task done (last done first)
- `to-do clear` removes every task

## How to test

Just run `to-do test`

## Framework

This console application has been created using [Laravel Zero](https://laravel-zero.com/), a micro-framework built on top of [Laravel](https://laravel.com).

## License

This is an open-source software licensed under the MIT license.
