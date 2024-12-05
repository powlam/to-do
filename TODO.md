This is going to be a TO-DO application.

# to-do

## DONE

- Check the current to-do's
    - `to-do check` returns a list of opened to-do's (ordered by created_at asc)
    - `to-do` (it also can be called this way, this is the default command)
    - It must return nothing if there is no task pending
- Add something to do (a string)
    - `to-do add` asks for the task, stores it, and returns its id
- Clear data
    - `to-do clear` removes every task, and resets the id
    - It must ask for confirmation

## TODO

- Mark something as done
    - `to-do done {Id}` the to-do is marked as done
- Mark all as done
    - `to-do done:all` all the opened to-do's are marked as done
- History
    - `to-do history` lists every task done: task, created_at and done_at (ordered by done_at desc)

https://github.com/nunomaduro/heminders
