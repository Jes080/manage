@extends('layouts.app')
@section('content')
@if(session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <h1 class="ms-3 mt-3">{{$title}}</h1>
    <p class="ms-3">This is the function page.</p>

    <!--Task Portal-->
    <button class="btn btn-success ms-3" style="width: 20%" data-bs-toggle="modal" data-bs-target="#add-task-modal">Add Task</button>

    <div class="card mx-auto mt-3 border border-dark-subtle border-2 shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 80%">

        <!-- Add Task Modal -->
        <div class="modal" id="add-task-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="text-white modal-header bg-success">
                        <h3 class="modal-title">Add Task</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Task Form -->
                        <form action="{{ route('store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="due">Due Date:</label>
                                <input type="date" name="due" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority Level:</label>
                                <select name="priority" class="form-control" required>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" required>
                                    <option value="Not Started">Not Started</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="m-3 btn btn-success">Create Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






<!-- Task Table -->
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <table class="table text-center custom-table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Priority Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach($tasks as $task)
                        <tr class="table-light">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->status }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <!-- Button trigger for update task modal -->
                                    <button class="btn btn-primary btn-sm update-task me-2" data-bs-toggle="modal" data-bs-target="#update-task-modal" data-task-id="{{ $task->id }}">Edit</button>
                                    <!-- Form for delete task -->
                                    <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>


<!-- Update Task Modal -->
<div class="modal" id="update-task-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-white modal-header bg-primary">
                <h3 class="modal-title">Edit Task</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="update-task-form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Add form fields with IDs -->
                    <input type="hidden" id="update-task-id" name="task_id">
                    <div class="form-group">
                        <label for="update-title">Title:</label>
                        <input required id="update-title" type="text" class="form-control" name="title" placeholder="Task Title">
                    </div>
                    <div class="form-group">
                        <label for="update-description">Description:</label>
                        <textarea required id="update-description" class="form-control" name="description" placeholder="Task Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="update-due">Due Date:</label>
                        <input required id="update-due" type="date" class="form-control" name="due">
                    </div>
                    <div class="form-group">
                        <label for="update-priority">Priority Level:</label>
                        <select required id="update-priority" class="form-control" name="priority">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update-status">Status:</label>
                        <select required id="update-status" class="form-control" name="status">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the update buttons
        const updateButtons = document.querySelectorAll('.update-task');

        // Add click event listener to each update button
        updateButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const taskId = this.getAttribute('data-task-id');
                // Set the form action dynamically
                document.getElementById('update-task-form').action = '/tasks/' + taskId;
                fetchTaskData(taskId);
            });
        });

        // Function to fetch task data by ID and populate the update form
        function fetchTaskData(taskId) {
            // Make an AJAX request to fetch task data
            fetch('/tasks/' + taskId)
                .then(response => response.json())
                .then(data => {
                    // Populate form fields with fetched data
                    document.getElementById('update-title').value = data.title;
                    document.getElementById('update-description').value = data.description;
                    document.getElementById('update-due').value = data.due;
                    document.getElementById('update-priority').value = data.priority;
                    document.getElementById('update-status').value = data.status;
                    document.getElementById('update-task-id').value = data.id;
                })
                .catch(error => console.error('Error fetching task data:', error));
        }
    });

    //alert
    // Automatically close the success message after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
    // Your JavaScript code here
    setTimeout(function() {
        var successAlert = document.getElementById('successAlert');
        if (successAlert !== null) {
            successAlert.classList.add('fade');
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 1000); // Fade duration is 1 second
        }
    });
});

</script>


@endsection
