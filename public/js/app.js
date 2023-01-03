function addEventListeners() {
  let reportDeleters = document.querySelectorAll('#delete-report');
  [].forEach.call(reportDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteReportRequest);
  });

  let starCreator = document.getElementsByClassName('star');
  [].forEach.call(starCreator, function(creator) {
    creator.addEventListener('click', sendCreateStarRequest);
  });

  let checkCreator = document.getElementsByClassName('check');
  [].forEach.call(checkCreator, function(creator) {
    creator.addEventListener('click', sendCreateCheckRequest);
  });

  // Notifications handler
  let notifyBTN = document.getElementById("notificationButton");
  sendAjaxRequest('get', '/api/user/notifications/count', null, notifyCounterHandler);
  notifyTimer = setInterval(()=>sendAjaxRequest('get', '/api/user/notifications/count', null, notifyCounterHandler), 5 * 1000);
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

function sendDeleteReportRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  event.preventDefault();
  sendAjaxRequest('delete', '/api/report/' + id, null, reportDeletedHandler);
}



function starAddedHandler(creator){
  //if (this.status != 200) window.reload();

  let counter = creator.lastChild;

  if(creator.classList.contains('fa-regular')){
    creator.classList.remove('fa-regular');
    creator.classList.add('fa-solid');
    counter.innerText = parseInt(counter.innerText) + 1;
  } else if (creator.classList.contains('fa-solid')){
    creator.classList.remove('fa-solid');
    creator.classList.add('fa-regular');
    counter.innerText = parseInt(counter.innerText) - 1;
  }
}

let notifyTimer;
function notifyCounterHandler(){
  if (this.status != 200)
    clearInterval(notifyTimer);
  const count = this.responseText >= 100 ? '99+' : this.responseText;
  const nav = document.getElementById("notificationCounter");
  if (nav) nav.innerText = count;
  const mobile = document.getElementById("notificationCounter2");
  if (mobile) this.responseText ? mobile.classList.remove("d-none") : mobile.classList.add("d-none");
  const offcanvas = document.getElementsByClassName("offcanvas-title")[0].children[0].innerHTML = this.responseText;
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

function reportDeletedHandler() {
  // if (this.status == 200) window.location = '/logout';
  let report = JSON.parse(this.responseText);
  let article = document.querySelector('article.rport[data-id="'+ report.id + '"]');
  article.remove();
}

window.onload = addEventListeners;

const titleTextArea = document.querySelector("#postTitle");
const titleCounter = document.querySelector("#count-postTitle");
const titleTypedCharacters = document.querySelector("#current-postTitle");
const maximumTitleCharacters = 200;

titleTextArea?.addEventListener("input", (event) => {

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
const textCounter = document.querySelector("#count-postText");
const textTypedCharacters = document.querySelector("#current-postText");
const maximumTextCharacters = 1000;

textTextArea?.addEventListener("input", (event) => {

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

const commentTextArea = document.querySelector("#commentText");
const commentCounter = document.querySelector("#count-commentText");
const commentTypedCharacters = document.querySelector("#current-commentText");
const maximumCommentCharacters = 250;

commentTextArea?.addEventListener("input", (event) => {

  const typedCharacters = commentTextArea.value.length;

  if (typedCharacters > maximumCommentCharacters) {
    return false;
  }

  commentTypedCharacters.textContent = typedCharacters;

  if (typedCharacters >= 150 && typedCharacters < 200) {
    commentCounter.classList = "text-warning";
  } else if (typedCharacters >= 200) {
    commentCounter.classList = "text-danger";
  }
});

const messageTextArea = document.querySelector("#message");
const messageCounter = document.querySelector("#count-message");
const messageTypedCharacters = document.querySelector("#current-message");
const maximumMessageCharacters = 250;

messageTextArea?.addEventListener("input", (event) => {

  const typedCharacters = messageTextArea.value.length;

  if (typedCharacters > maximumMessageCharacters) {
    return false;
  }

  messageTypedCharacters.textContent = typedCharacters;

  if (typedCharacters >= 150 && typedCharacters < 200) {
    messageCounter.classList = "text-warning";
  } else if (typedCharacters >= 200) {
    messageCounter.classList = "text-danger";
  }
});

const passwordInput = document.querySelector("#password");
const passwordMin = 6;
const passwordMinSpan = document.querySelector("#password-min");
const passwordazSpan = document.querySelector("#password-az");
const passwordAZSpan = document.querySelector("#password-AZ");
const passwordDigitSpan = document.querySelector("#password-digit");

passwordInput?.addEventListener("input", (event) => {
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

//acho que não está a ser usado
const accordionButtons = document.querySelectorAll('.accordionfaq');
accordionButtons.forEach(button => {
  button.addEventListener('click', function() {
    // Get the content panel that corresponds to this accordion button
    const panel = this.nextElementSibling;
    // Toggle the display of the panel
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
});

let inputFile = document.getElementById("avatar");
let avatarName = document.getElementById("avatarName");

inputFile?.addEventListener("change", ()=>{
  let inputAvatar = document.querySelector("input[type=file]").files[0];

  avatarName.innerText = inputAvatar.name;
});

let topButton = document.getElementById("topBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    topButton.style.display = "block";
  } else {
    topButton.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}



//notify offcanvas update on click
let notifyTypeHandler = {
  'new_answers': (obj)=> {
    const notification = document.createElement('div');
    notification.classList.add('card');
    const card = document.createElement('div');
    card.classList.add('card-body');
    const markRead = document.createElement('a');
    markRead.classList.add('btn');
    markRead.innerText = 'Mark as read';
    notification.appendChild(card);
    // notification.appendChild(markRead);
    card.innerText = 'You received a new answer!\n\n' + obj.notificationdate;
    // markRead.addEventListener("click", function(e) {
    //   // sendAjaxRequest('PATCH', 'api/user/notifications/read/'+obj.id, null, null);
    //   e.stopPropagation();
    // });
    notification.addEventListener("click", function(e) {
      // sendAjaxRequest('PATCH', 'api/user/notifications/read/'+obj.id, null, null);
      window.location.href = '/posts/'+obj.new_content.questionid+'#answer-'+obj.new_content.postid;
    });
    return notification;
  },
  'new_questions': (obj)=> {
    // `<p>answers @ ${obj.new_content.notificationdate}</p>`,
    const notification = document.createElement('div');
    notification.classList.add('card');
    const card = document.createElement('div');
    card.classList.add('card-body');
    const markRead = document.createElement('a');
    markRead.classList.add('btn');
    markRead.innerText = 'Mark as read';
    notification.appendChild(card);
    // notification.appendChild(markRead);
    card.innerText = 'A new question has been posted on a tag you follow!\n' + obj.notificationdate;
    notification.addEventListener("click", function(e) {
      // sendAjaxRequest('PATCH', 'api/user/notifications/read/'+obj.id, null, null);
      window.location.href = '/posts/'+obj.new_content.postid;
      
    });
    return notification;
  },
  'new_comments': (obj)=> {
    const notification = document.createElement('div');
    notification.classList.add('card');
    const card = document.createElement('div');
    card.classList.add('card-body');
    notification.appendChild(card);
    card.innerText = 'A new comment has been posted on your question!\n' + obj.notificationdate;
    notification.addEventListener("click", function() {
      // notification.innerText = 'clicked';
      // sendAjaxRequest('PATCH', '/api/user/notifications/read', null, null);
      window.location.href = '/posts/'+obj.new_content.postid;
    });
    return notification;
  },
  'new_badges': (obj)=> {
    const notification = document.createElement('div');
    notification.classList.add('card');
    const card = document.createElement('div');
    card.classList.add('card-body');
    notification.appendChild(card);
    card.innerText = 'You received a new badge!\n' + obj.notificationdate;
    notification.addEventListener("click", function() {
      // notification.innerText = 'clicked';
      // sendAjaxRequest('patch', '/api/user/notifications/read/', null, null);
      // window.location.href = 'users/????/badges';
    });
    return notification;
  },
  'new_stars': (obj)=> {
    const notification = document.createElement('div');
    notification.classList.add('card');
    const card = document.createElement('div');
    card.classList.add('card-body');
    notification.appendChild(card);
    card.innerText = 'Your post just received a like!\n' + obj.notificationdate;
    notification.addEventListener("click", function() {
      // notification.innerText = 'clicked';
      // sendAjaxRequest('patch', 'api/user/notifications/read/'+obj.id, null, null);
      window.location.href = '#'; //'/posts/'+obj.new_content.postid;
    });
    return notification;
  },
}
let notificationsArray = [];
function updateNotify() {
  const notify = document.getElementById("notificationsArea");
  if (this.status != 200 || !notify) return;
  // notify.innerHTML = this.responseText;
  notify.innerHTML = "";
  obj = JSON.parse(this.responseText);
  obj.content.forEach(elm => {
    notify?.appendChild(notifyTypeHandler[elm.notifytype](elm));
  });
  // console.log(obj);
}
const notifyBtn = document.getElementById("notificationButton");
if (notifyBtn) notifyBtn.addEventListener("click", ()=>sendAjaxRequest('get', '/api/user/notifications/', null, updateNotify));
