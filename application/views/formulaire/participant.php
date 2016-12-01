<?php include_once('/../header.php'); ?>
<html>
<head>
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/bootstrap.min.css");?>" />
	<link rel= "stylesheet" href="<?php echo base_url("dist/css/signin.css");?>" />
  <script src="../../../js/angular.js"></script>
  <script src="../../../js/todoList.js"></script>
</head>
<body>
  <header>
      <h1>Todo List</h1>
  </header>
    <div class="container">
      <section ng-controller="todoCtrl">
          <form id="todo-form" ng-submit="addTodo()">
              <input id="new-todo" placeholder="Que devez-vous faire ?" ng-model="newTodo" />
          </form>
          <article ng-show="todos.length">
              <ul id="todo-list">
                  <li ng-repeat="todo in todos" ng-class="{completed: todo.completed}">
                      <div class="view">
                          <input class="mark" type="checkbox" ng-model="todo.completed" />
                          <span>{{todo.title}}</span>
                          <span class="close" ng-click="removeTodo(todo)">x</span>
                      </div>
                  </li>
              </ul>
          </article>
          <input id="mark-all" type="checkbox" ng-model="allChecked" ng-click="markAll(allChecked)" />
          <label class="btn btn-info" for="mark-all">Tout cocher</label>
          <button class="btn btn-danger" ng-click="clearCompletedTodos()">Supprimer les tâches cochées</button>
      </section>
    </div>
<body>
