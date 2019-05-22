<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		<title>Clean Todo</title>
	</head>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Clean Todo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{url.get("todo")}}">Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{url.get("index/logout")}}">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
	<body>
    <div class="container">
            <div class="d-flex justify-content-center">
                <h1 class="display-1 ">Clean Todo</h1>
            </div>
            <div class="d-flex justify-content-center">
                {{ flashSession.output() }}
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-warning mb-3 mr-3" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add New Todo</button>
                <form class="form-inline mb-3" action="todo/pdf" method="post">
                    <button class="btn btn-primary" type="submit" name="add"><i class="fas fa-file-pdf"></i> Export to PDF</button>
                </form>
            </div>

              <table class="table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  {% for todo in todos %}
                    <tr>
                      <td>{{ todo.getTitle() }}</td>
                      <td>{{ todo.getDetail().getDetail() }}</td>
                      <td>{{ todo.getPriority().getPriority() }}</td>
                      <td>{{ todo.getStatus().getStatus() }}</td>
                      <td>{{ todo.getDateStart() }}</td>
                      <td>{{ todo.getDateEnd() }}</td>
                      <td class="text-center row">
                        <button type="button" class="btn btn-warning mr-3" 
                        data-toggle="modal" 
                        data-target="#editModal" 
                        data-id="{{ todo.getId() }}"  
                        data-todo="{{ todo.getTitle() }}"
                        data-detail="{{ todo.getDetail().getDetail() }}"
                        data-priority="{{ todo.getPriority().getId() }}"
                        data-status="{{ todo.getStatus().getId() }}"
                        data-date-start="{{ todo.getDateStart() }}"
                        data-date-end="{{ todo.getDateEnd() }}">
                        <i class="fas fa-edit"></i></button>
                        <form action="todo/delete" method="post">
                          <input type="hidden" name="id" value="{{ todo.getId() }}">
                          <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  {% endfor %}
                </tbody>
              </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Todo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="todo/update" method="post">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="todo" class="col-form-label">Todo Title:</label>
                    <input name="title" type="text" class="form-control" id="title" required>
                  </div>
                  <div class="form-group">
                    <label for="detail" class="col-form-label">Detail:</label>
                    <input name="detail" type="text" class="form-control" id="detail" required>
                  </div>
                  <div class="form-group">
                    <label for="priority" class="col-form-label">Priority:</label>
                    <select class="form-control" id="priority" name="priority">
                      {% for todoPriority in todoPriorities %}
                        <option value="{{todoPriority.getId()}}">{{todoPriority.getPriority()}}</option>
                      {% endfor %}
                    </select>                  
                  </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Status:</label>
                    <select class="form-control" id="status" name="status">
                      {% for todoStatus in todoStatuses %}
                        <option value="{{todoStatus.getId()}}">{{todoStatus.getStatus()}}</option>
                      {% endfor %}
                    </select>                  
                  </div>
                  <div class="form-group">
                    <label for="date-start" class="col-form-label">Date Start:</label>
                    <input data-date-format="dd-mm-yyyy" id="editStartDatePicker" name="start-date">
                  </div>
                  <div class="form-group">
                    <label for="date-end" class="col-form-label">Date End:</label>
                    <input data-date-format="dd-mm-yyyy" id="editEndDatePicker" name="end-date">
                  </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add Todo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="todo/insert" method="post">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="todo" class="col-form-label">Todo Title:</label>
                    <input name="title" type="text" class="form-control" id="title" required>
                  </div>
                  <div class="form-group">
                    <label for="detail" class="col-form-label">Detail:</label>
                    <input name="detail" type="text" class="form-control" id="detail" required>
                  </div>
                  <div class="form-group">
                    <label for="priority" class="col-form-label">Priority:</label>
                    <select class="form-control" id="priority" name="priority">
                      {% for todoPriority in todoPriorities %}
                        <option value="{{todoPriority.getId()}}">{{todoPriority.getPriority()}}</option>
                      {% endfor %}
                    </select>                  
                  </div>
                  <div class="form-group">
                    <label for="status" class="col-form-label">Status:</label>
                    <select class="form-control" id="status" name="status">
                      {% for todoStatus in todoStatuses %}
                        <option value="{{todoStatus.getId()}}">{{todoStatus.getStatus()}}</option>
                      {% endfor %}
                    </select>                  
                  </div>
                  <div class="form-group">
                    <label for="date-start" class="col-form-label">Date Start:</label>
                    <input data-date-format="dd-mm-yyyy" id="startDatePicker" name="start-date">
                  </div>
                  <div class="form-group">
                    <label for="date-end" class="col-form-label">Date End:</label>
                    <input data-date-format="dd-mm-yyyy" id="endDatePicker" name="end-date">
                  </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="id" id="editId">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style type="text/css">
        .datepicker {
            font-size: 0.875em;
        }
        
    </style>
    <script>
    $('#editModal').on('show.bs.modal', function (event) {
      var startDate, endDate
      if (event.namespace === 'bs.modal') {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var todo = button.data('todo');
        var detail = button.data('detail');
        var priority = button.data('priority');
        var status = button.data('status');
        startDate = button.data('date-start');
        endDate = button.data('date-end');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-footer input').val(id)
        modal.find('.modal-body #title').val(todo)
        modal.find('.modal-body #detail').val(detail)
        modal.find('.modal-body #priority').val(priority)
        modal.find('.modal-body #status').val(status)
        modal.find('.modal-body #editStartDatePicker').val(startDate)
        modal.find('.modal-body #editEndDatePicker').val(endDate)
      }
          
      $('#editStartDatePicker').datepicker({
          weekStart: 1,
          daysOfWeekHighlighted: "6,0",
          autoclose: true,
          todayHighlight: true,
      });
      $('#editStartDatePicker').datepicker("setStartDate", new Date());
      $('#editStartDatePicker').datepicker("setDate", new Date(startDate.split("-").reverse().join("-")));

      $('#editEndDatePicker').datepicker({
          weekStart: 1,
          daysOfWeekHighlighted: "6,0",
          autoclose: true,
          todayHighlight: true,
      });
      $('#editEndDatePicker').datepicker("setStartDate", new Date());
      $('#editEndDatePicker').datepicker("setDate", new Date(endDate.split("-").reverse().join("-")));
      
    })

    $('#startDatePicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#startDatePicker').datepicker("setStartDate", new Date());
    $('#startDatePicker').datepicker("setDate", new Date());

    $('#endDatePicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#endDatePicker').datepicker("setStartDate", new Date());
    $('#endDatePicker').datepicker("setDate", new Date());
    </script>
	</body>
</html>

