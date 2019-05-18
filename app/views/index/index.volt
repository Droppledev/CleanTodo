<!DOCTYPE html>
<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		<title>Clean Todo</title>
	</head>
	<body>
    <div class="container">
            <div class="d-flex justify-content-center">
                <h1 class="display-1 ">Clean Todo</h1>
            </div>
            <div class="d-flex justify-content-center">
                <form class="form-inline mb-3" action="index/insert" method="post">
                    <input class="form-control mr-3" type="text" name="todo" id="todo" placeholder="Type your todo here...">
                    <button class="btn btn-primary" type="submit" name="add"><i class="fas fa-plus"></i></button>
                </form>
            </div>
            <div class="d-flex justify-content-center">
                <form class="form-inline mb-3" action="index/pdf" method="post">
                    <button class="btn btn-primary" type="submit" name="add"><i class="fas fa-file-pdf"></i> Export to PDF</button>
                </form>
            </div>

            <div class="d-flex justify-content-center">
              <table class="table col-md-4">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  {% for index, todo in todos %}
                    <tr>
                      <td>{{ todo.getTitle() }}</td>
                      <td class="text-center row">
                        <button type="button" class="btn btn-warning mr-3" data-toggle="modal" data-target="#exampleModal" data-id="{{ todo.getId() }}"  data-todo="{{ todo.getTitle() }}"><i class="fas fa-edit"></i></button>
                        <form action="index/delete" method="post">
                          <input type="hidden" name="id" value="{{ todo.getId() }}">
                          <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure to delete?')"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Todo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="index/update" method="post">
              <div class="modal-body">
                  <div class="form-group">
                    <label for="todo" class="col-form-label">Todo:</label>
                    <input name="title" type="text" class="form-control" id="title">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      var todo = button.data('todo');
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-footer input').val(id)
      modal.find('.modal-body input').val(todo)
    })
    </script>
	</body>
</html>

