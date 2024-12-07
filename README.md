# TO-DO-app

This console application was created by [Paul Albandoz](https://github.com/powlam), and is my first approach to console applications made using the Laravel ecosystem.

- It is a TO-DO application.
- It allows storing tasks and marking them as done. It also adds functionality to list and clear the tasks.

## Bags

The tasks are organized into different bags (initially a default bag is created).
Always one of the bags is marked as active, and is the one used by default by all the commands.

------

## How it works

I recommend creating an alias (`alias todo="php [PATH]/to-do"`); much more comfortable.

- `todo bags` lists all the bags, indicating which is the active one (ordered by bag name)
- `todo check:bags` checks each bag to know if they have opened tasks
- `todo bag:new` creates a new bag
- `todo bag {Id}` sets the bag as active
- `todo bag:rename {?Id}` renames a bag
- `todo bag:delete {?Id}` deletes a bag

The following commands refer to the active bag:

- `todo` or `todo check` returns a list of opened to-do's (oldest first)
    - It returns nothing if there is no task pending
- `todo add` asks for the task description, stores it, and returns its id
- `todo done {Id}` the task is marked as done
- `todo done:all` all the opened tasks are marked as done
- `todo history` lists every task done (last done first)
- `todo clear` removes every task

## How to test

Just run `todo test`

## Framework

This console application has been created using [Laravel Zero](https://laravel-zero.com/), a micro-framework built on top of [Laravel](https://laravel.com).

## License

This is an open-source software licensed under the MIT license.
