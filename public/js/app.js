function addEventListeners() {
  let postDeleters = document.querySelectorAll('article.post div.card div.card-body a.delete');
  [].forEach.call(postDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeletePostRequest);
  });

  let commentDeleters = document.querySelectorAll('#delete-comment');
  [].forEach.call(commentDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteCommentRequest);
  });

  let userDeleters = document.querySelectorAll('article.userbuttons a.delete');
  [].forEach.call(userDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteUserRequest);
  });
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendDeletePostRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  event.preventDefault();
  sendAjaxRequest('delete', '/api/posts/' + id, null, postDeletedHandler);
}

function sendDeleteCommentRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  event.preventDefault();
  sendAjaxRequest('delete', '/api/comments/' + id, null, commentDeletedHandler);
}

function sendDeleteUserRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  event.preventDefault();
  sendAjaxRequest('delete', '/api/users/' + id, null, userDeletedHandler);
}

function postDeletedHandler() {
  let post = JSON.parse(this.responseText);
  let article = document.querySelector('article.post[data-id="'+ post.id + '"]');
  article.remove();
}

function commentDeletedHandler() {
  let comment = JSON.parse(this.responseText);
  let article = document.querySelector('article.comment[data-id="'+ comment.id + '"]');
  article.remove();
}

function userDeletedHandler() {
  if (this.status == 200) window.location = '/logout';
  let user = JSON.parse(this.responseText);
  let article = document.querySelector('article.userbuttons[data-id="'+ user.id + '"]');
  article.remove();
}

window.onload = addEventListeners;

const titleTextArea = document.querySelector("#title");
const titleCounter = document.querySelector("#count-title");
const titleTypedCharacters = document.querySelector("#current-title");
const maximumTitleCharacters = 200;

titleTextArea.addEventListener("input", (event) => {

    const typedCharacters = titleTextArea.value.length;

    if (typedCharacters > maximumTitleCharacters) {
        return false;
    }

    titleTypedCharacters.textContent = typedCharacters;

    if (typedCharacters >= 100 && typedCharacters < 150) {
      titleCounter.classList = "text-warning";
    } else if (typedCharacters >= 150) {
       titleCounter.classList = "text-danger";
    }
});

const textTextArea = document.querySelector("#postText");
const textCounter = document.querySelector("#count-text");
const textTypedCharacters = document.querySelector("#current-text");
const maximumTextCharacters = 1000;

textTextArea.addEventListener("input", (event) => {

    const typedCharacters = textTextArea.value.length;

    if (typedCharacters > maximumTextCharacters) {
      return false;
    }

    textTypedCharacters.textContent = typedCharacters;

    if (typedCharacters >= 100 && typedCharacters < 150) {
      textCounter.classList = "text-warning";
    } else if (typedCharacters >= 150) {
      textCounter.classList = "text-danger";
    }
});



