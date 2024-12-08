This is going to be a TO-DO application.

# to-do

## DONE

- Check the current to-do's
    - `todo check` returns a list of opened to-do's (ordered by created_at asc)
    - `todo` (it also can be called this way, this is the default command)
    - It must return nothing if there is no task pending
- Add something to do (a string)
    - `todo add` asks for the task description, stores it, and returns its id
- Mark something as done
    - `todo done {Id}` the task is marked as done
- Mark all as done
    - `todo done:all` all the opened tasks are marked as done
- Clear data
    - `todo clear` removes every task, and resets the id
    - It must ask for confirmation
- History
    - `todo history` lists every task done: task, created_at and done_at (ordered by done_at desc)

- Bags
    - Different bags for the to-do's.
    - One of the bags is the active one
    - Create a default bag initially
    - `todo bags` lists all the bags, indicating which is the active one (ordered by bag name)
    - `todo bag:new` creates a new bag
    - `todo bag {Id}` sets the bag as active
    - `todo check:bags` checks each bag to know if they have opened tasks; it does not list the tasks

## TODO

- History
    - Fix the test that checks if the table has valid content

- Bags
    - `todo bag:rename {?Id}` renames a bag
        - renames the active one if no Id is provided
    - `todo bag:delete {?Id}` deletes a bag; requires confirmation
        - deletes the active one if no Id is provided


https://github.com/nunomaduro/heminders
