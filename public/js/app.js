function addEventListeners() {
  let postDeleters = document.querySelectorAll('#delete-post');
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

  let starCreator = document.getElementsByClassName('star');
  [].forEach.call(starCreator, function(creator) {
    creator.addEventListener('click', sendCreateStarRequest);
  });

  let checkCreator = document.getElementsByClassName('check');
  [].forEach.call(checkCreator, function(creator) {
    creator.addEventListener('click', sendCreateCheckRequest);
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

function sendCreateStarRequest(event){
  let postid = this.closest('article').getAttribute('data-id');
  let userid = this.closest('article').getAttribute('user-id');
  event.preventDefault();
  if(this.classList.contains('fa-regular')){
    sendAjaxRequest('put', '/api/star/' + userid + '/' + postid, null, ()=>{return starAddedHandler(this)});
  } else {
    sendAjaxRequest('delete', '/api/star/' + userid + '/' + postid, null, ()=>{return starAddedHandler(this)});
  }
  
}

function sendCreateCheckRequest(event){
  let postid = this.closest('article').getAttribute('data-id');
  event.preventDefault();
  sendAjaxRequest('put', '/api/posts/' + postid + '/correct', null, ()=>{return checkAddedHandler(this)});
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



function starAddedHandler(creator){
  //if (this.status != 200) window.reload();

  if(creator.classList.contains('fa-regular')){
    creator.classList.remove('fa-regular');
    creator.classList.add('fa-solid');
    creator.innerText = parseInt(creator.innerText) + 1;
  } else if (creator.classList.contains('fa-solid')){
    creator.classList.remove('fa-solid');
    creator.classList.add('fa-regular');
    creator.innerText = parseInt(creator.innerText) - 1;
  }
}

function checkAddedHandler(creator){
  //if (this.status != 200) window.reload();

  if(creator.classList.contains('fa-regular')){
    creator.classList.remove('fa-regular');
    creator.classList.add('fa-solid');
  } else if (creator.classList.contains('fa-solid')){
    creator.classList.remove('fa-solid');
    creator.classList.add('fa-regular');
  }
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

const passwordInput = document.querySelector("#password");
const passwordMin = 6;
const passwordMinSpan = document.querySelector("#password-min");
const passwordazSpan = document.querySelector("#password-az");
const passwordAZSpan = document.querySelector("#password-AZ");
const passwordDigitSpan = document.querySelector("#password-digit");

passwordInput.addEventListener("input", (event) => {
  const typedCharacters = passwordInput.value.length;
  const str = passwordInput.value;

  if(typedCharacters >= passwordMin) {
    passwordMinSpan.classList = "text-success";
  } else {
    passwordMinSpan.classList = "";
  }

  if(/[a-z]/.test(str)) {
    passwordazSpan.classList = "text-success";
  } else {
    passwordazSpan.classList = "";
  }

  if(/[A-Z]/.test(str)) {
    passwordAZSpan.classList = "text-success";
  } else {
    passwordAZSpan.classList = "";
  }

  if(/[0-9]/.test(str)) {
    passwordDigitSpan.classList = "text-success";
  } else {
    passwordDigitSpan.classList = "";
  }

});

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