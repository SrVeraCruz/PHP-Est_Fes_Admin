/* Global Variables */ 
const baseUrl = 'http://localhost:8081/';

const endpointLogin = `${baseUrl}api/users/login`;
const endpointLogout = `${baseUrl}api/users/logout`;
const endpointRegister = `${baseUrl}api/users/register`;
const endpointUsers = `${baseUrl}api/users`;
const endpointNews = `${baseUrl}api/news`;
const endpointEvents = `${baseUrl}api/events`;
const endpointNewsletter = `${baseUrl}api/newsletter`;
const endpointCategories = `${baseUrl}api/categories`;
const endpointItems = `${baseUrl}api/items`;

const endpointImageCld = 'https://api.cloudinary.com/v1_1/dbfaih2du/image/upload';
const endpointRawCld = 'https://api.cloudinary.com/v1_1/dbfaih2du/raw/upload';

const rawPathCld = "https://res-console.cloudinary.com/dbfaih2du/media_explorer_thumbnails/"

const searchUrl = new URLSearchParams(window.location.search)
const pageUrl = location.pathname
const pageName = pageUrl.substring(pageUrl.lastIndexOf("/") + 1)

const navbar_hamburguer = document.getElementById("navbar-hamburguer");
const aside = document.getElementById("aside");

const pageIndicator = document.getElementById("pageIndicator");


/* Navbar event */ 
//////////////////////////////////////////////////////////
if(navbar_hamburguer && aside) {
  navbar_hamburguer.addEventListener("click", () => {
    navbar_hamburguer.classList.toggle('open')
    aside.classList.toggle('open')

  })
}

/* Global Functions */ 
//////////////////////////////////////////////////////////
const fetchAllUsers = async () => {
  return await axios.get(endpointUsers)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneUser = async (id) => {
  return await axios.get(`${endpointUsers}?id=${id}`)
  .then(res => {
    return res.data
  })
  .catch(err => {
    console.error(err.message)
  })
}

const fetchAllNews = async () => {
  return await axios.get(endpointNews)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneNews = async (id) => {
  return await axios.get(`${endpointNews}?id=${id}`)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchAllEvents = async () => {
  return await axios.get(endpointEvents)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneEvent = async (id) => {
  return await axios.get(`${endpointEvents}?id=${id}`)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchAllSubscriptions = async () => {
  return await axios.get(endpointNewsletter)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneSubscription = async (id) => {
  return await axios.get(`${endpointNewsletter}?id=${id}`)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchAllCats = async () => {
  return await axios.get(endpointCategories)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneCat = async (id) => {
  return await axios.get(`${endpointCategories}?id=${id}`)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const showSelCatOptions = (cats) => {
  const selectCat = document.getElementById("selectCat")
  
  if (cats && selectCat) {
    cats.forEach(cat => {
      selectCat.innerHTML += `
      <option value="${cat.id}">${cat.name}</option>
      `
    })
  }
}

const fetchAllItems = async () => {
  return await axios.get(endpointItems)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const fetchOneItem = async (id) => {
  return await axios.get(`${endpointItems}?id=${id}`)
    .then(res => {
      return res.data
    })
    .catch(err => {
      console.error(err.message)
    })
}

const handleUpload = async (file) => {
  const data = new FormData()
  data.append('file', file)
  data.append('upload_preset', 'est_uploads_file')

  if(file.type === 'application/pdf') {
    const res = await axios.post(endpointRawCld ,data)
    const fileUrl = `${rawPathCld + res.data.asset_id}/download`
    return fileUrl
  }

  const res = await axios.post(endpointImageCld ,data)
  return res.data.secure_url
}

const contentItemElement = (title,description) => {
  return `
    <div id="item">
      <button id="removeContentItemBtn" type="button">
        <span></span>
        <span></span>
      </button>
      <div id="element">
        <label>Sub-title:</label>
        <input type="text" name="data_content_title[]" value="${title || ""}" placeholder="e.g: Presentation">
      </div>
      <div id="element">
        <label>Description:</label>
        <textarea name="data_content_desc[]" class="summernote">${description || ""}</textarea>
      </div>
    </div>
  `
}

const addContentItemEvent = () => {
  const addContentItemBtn = document.getElementById("addContentItemBtn");
  addContentItemBtn.onclick = () => {
    const listItem = document.getElementById('items');
    const item = document.createElement('div')
    
    item.innerHTML = contentItemElement()

    listItem.appendChild(item)
    
    addSummernote()
    
    removeContentItemEvent()
  }
}

const removeContentItemEvent = () => {
  const removeContentItemBtns = document.querySelectorAll("#removeContentItemBtn");
  removeContentItemBtns.forEach(btn => {
    btn.onclick = (event) => {
      event.target.parentElement.parentElement.remove()
    }
  })
}

const appendConfirmDeleteBox = () => {
  const main = document.getElementById('main')
  
  main.innerHTML += `
    <div 
      id="confirmDelBox" 
      class="fixed top-[50%] translate-y-[-50%] 
        left-[50%] translate-x-[-50%] bg-white 
        p-20 px-14 rounded-2xl border border-gray-200 
        shadow-lg flex-col gap-4 items-center 
        justify-center text-center transition-all 
        duration-200 ease-in-out z-[61] hidden
      "
    >

      <h2>
        Do you want to unsubscribe 
        <span id="confirmDelTitle" class="font-semibold">
          Item name
        </span>
      </h2>
      <div class="flex gap-2">
        <button id="cancelDelete" class="btn-primary">
          No
        </button>
        <form id="FormConfirmDelete">
          <button 
            id="confirmDelId"
            name="delete_id"
            type="submit" 
            class="btn-red"
          >
            Yes
          </button>
        </form>
      </div>
    </div>

    <div 
      id="sideOutDelete" 
      class="min-w-full min-h-screen bg-dark/50 
        fixed top-0 left-0 z-[60] cursor-pointer hidden
      "
    ></div>
  `
}

const unshowConfirmDeleteBox = (name) => {
  const confirmDelBox = document.getElementById("confirmDelBox")
  const sideOutDelete = document.getElementById("sideOutDelete")

  confirmDelBox.classList.replace('flex', 'hidden');
  sideOutDelete.classList.add("hidden");

  if(pageIndicator.childElementCount === 3) {
    pageIndicator.removeChild(pageIndicator.lastElementChild)
  }
  addDeleteElementEvent(name)
}

const showDeleteBox = (name) => {
  appendConfirmDeleteBox()
  
  const confirmDelBox = document.getElementById("confirmDelBox")
  const sideOutDelete = document.getElementById("sideOutDelete")
  const cancelDeleteBtn = document.getElementById('cancelDelete')
  
  confirmDelBox.classList.replace('hidden', 'flex');
  sideOutDelete.classList.remove("hidden");
  changePageIndicator('Delete')
  
  cancelDeleteBtn.onclick = () => {
    unshowConfirmDeleteBox(name)
  }

  sideOutDelete.onclick = () => {
    unshowConfirmDeleteBox(name)
  }
}

const submitFormDelete = (endpoint) => {
  const formConfirmDelete = document.getElementById('FormConfirmDelete')
  formConfirmDelete.onsubmit = async (event) => {
    event.preventDefault()
    
    const formData = new FormData()
    formData.append("delete_id", event.target.delete_id.value)
    
    await axios.post(endpoint, formData)
    .then(() => {
      location.reload();
    })
    .catch(err => {
      toastrAlert(err)
    })
  }
}

const changePageIndicator = (option='') => {
  if(pageIndicator.childElementCount === 3) {
    pageIndicator.removeChild(pageIndicator.lastElementChild)
  }

  pageIndicator.innerHTML += `
    <li>
      <a href="#">${option}</a>
    </li>
  `
}

const addDeleteElementEvent = (name) => {
  document.querySelectorAll("#deleteBtn").forEach(btn => {
    btn.onclick = () => {
      showDeleteBox(name)
      switch(name) {
        case 'user':
          fetchOneUser(btn.value).then(user => {
            showInfosToDelete(user, endpointUsers)
          });
          break;

        case 'news':
          fetchOneNews(btn.value).then(news => {
            showInfosToDelete(news, endpointNews)
          });
          break;

        case 'event':
          fetchOneEvent(btn.value).then(event => {
            showInfosToDelete(event, endpointEvents)
          });
          break;

        case 'newsletter':
          fetchOneSubscription(btn.value).then(sub => {
            showInfosToDelete(sub, endpointNewsletter)
          })
          break;

        case 'cat':
          fetchOneCat(btn.value).then(cat => {
            showInfosToDelete(cat, endpointCategories)
          })
          break;

        case 'item':
          fetchOneItem(btn.value).then(item => {
            showInfosToDelete(item, endpointItems)
          });
          break;

        default:
          console.log('invalid delete event name')
          break;
      }
    }
  })
}

const addEditElementEvent = (name) => {
  document.querySelectorAll("#editBtn").forEach(btn => {
    btn.onclick = () => {
      changePageIndicator('Edit')
      switch(name) {
        case 'cat':
          fetchOneCat(btn.value).then(cat => {
            showCatToEdit(cat)
          })
          break

        case 'newsletter':
          fetchOneSubscription(btn.value).then(sub => {
            showSubscriptionToEdit(sub)
          })
          break

        default:
          console.log('invalid edit event name')
          break
      }
    }
  })
}

const showInfosToDelete = (data, endpoint) => {
  document.getElementById("confirmDelTitle").innerText = 
    data.email ||
    data.name || 
    data.title
  ;

  document.getElementById("confirmDelId").value = data.id

  submitFormDelete(endpoint)
}

const toggleCheckboxValueEvent = () => {
  document.querySelectorAll('input[type="checkbox"]').forEach(cbox => {
    cbox.onclick = () => {
      cbox.value = cbox.checked === true ? 'on' : 'off'
    }
  })
}

const formatSlug = (inputString = '') => {
  const cleanedString = inputString
  .toLowerCase()
  .replace(/[^\w\s]/g, '')
  .replace(/\s+/g, '-')
  .replace(/-+/g, '-')

  return cleanedString;
}

const getItemDataContent = () => {
  const data_content_title = document.querySelectorAll('input[name="data_content_title[]')
  const data_content_desc = document.querySelectorAll('textarea[name="data_content_desc[]')
  const data_content = []

  for (i = 0; i < data_content_title.length; i++) {
    data_content.push({
      'title': data_content_title[i].value,
      'description': data_content_desc[i].value
    })
  }
  return data_content
}

const getContentPage = () => {
  return document.getElementById('contentPage').value
}

const getEventTimeInterval = () => {
  const timeStart = document.getElementById("timeStart").value
  const timeEnd = document.getElementById("timeEnd").value

  const time = `${timeStart} - ${timeEnd}`

  return time === ' - ' ? '' : time
}

const addDataTable = () => {
  jQuery(document).ready(() => {
    jQuery('#myDataTable').DataTable();
  })
}

const addSummernote = () => {
  jQuery('.summernote').summernote({
    placeholder: 'e.g: Le diplomé de la filière Génie Informatique',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['codeview', 'help']]
    ]
  });
}

const toastrAlert = (err) => {
  if (err.response && err.response.data) {
    if (err.response.data.message_warning) {
      toastr.warning(err.response.data.message_warning)
    } else if (err.response.data.message_error) {
      toastr.error(err.response.data.message_error)
    } else {
      toastr.error('Something went wrong!');
    }
  } else {
    toastr.error('Something went wrong!');
  }
}


/* Register Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'register.php') {
  const formUserRegister = document.getElementById('formUserRegister')

  formUserRegister.onsubmit = async (event) => {
    event.preventDefault();

    let avatarUrl = ''
    const avatar = event.target.avatar.files[0]

    if(avatar) {
      avatarUrl = await handleUpload(avatar)
    }

    const formData = new FormData();
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('cpassword', event.target.cpassword.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('avatar', avatarUrl)
    
    await axios.post(endpointRegister, formData)
    .then(() => {
      window.location.href = "login.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }
}
  
  /* Login Page */ 
//////////////////////////////////////////////////////////

if(pageName === 'login.php') {
  const formUserLogin = document.getElementById('formUserLogin')

  formUserLogin.onsubmit = async (event) => {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    
    await axios.post(endpointLogin, formData)
    .then(() => {
      window.location.href = "index.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }
}

/* Logout event */ 
//////////////////////////////////////////////////////////
const logoutForm = document.getElementById("logoutForm");

if(logoutForm) {
  logoutForm.onsubmit = (event) => {
    event.preventDefault()
    
    axios.post(endpointLogout)
      .then(() => {
        location.href = 'login.php'
      })
      .catch(err => {
        toastrAlert(err)
      })
  }
}


/*  Dashboard Page */ 
//////////////////////////////////////////////////////////

if(pageName === 'index.php') {
  const usersQte = document.getElementById('usersQte')
  const usersBlockQte = document.getElementById('usersBlockQte')
  const newsQte = document.getElementById('newsQte')
  const eventsQte = document.getElementById('eventsQte')
  const subscriptionsQte = document.getElementById('subscriptionsQte')
  const catsQte = document.getElementById('catsQte')
  const itemsQte = document.getElementById('itemsQte')

  fetchAllUsers().then(users => {
    if (users.length) {
      const tUsers = users.filter(user => {return user.status !== '1'})
      usersQte.innerText = tUsers.length
    }
  })

  fetchAllUsers().then(users => {
    if (users.length) {
      const bUsers = users.filter(user => {return user.status === '1'})
      usersBlockQte.innerText = bUsers.length
    }
  })

  fetchAllNews().then(news => {
    if (news.length) {
      newsQte.innerText = news.length
    }
  })
  
  fetchAllEvents().then(events => {
    if (events.length) {
      eventsQte.innerText = events.length
    }
  })
  
  fetchAllSubscriptions().then(subscriptions => {
    if (subscriptions.length) {
      subscriptionsQte.innerText = subscriptions.length
    }
  })

  fetchAllCats().then(cats => {
    if (cats.length) {
      catsQte.innerText = cats.length
    }
  })

  fetchAllItems().then(items => {
    if (items.length) {
      itemsQte.innerText = items.length
    }
  })
}


/*  Users Page */ 
//////////////////////////////////////////////////////////

//  Users view 
if(pageName === 'user-view.php') {
  const tableUser = document.getElementById('tableUserData')
  
  const showUsers = (users) => {
    tableUser.innerHTML = ''
    
    const getUserRole = (userRole) => {
      if (userRole === '0') {
        return 'User'
      } else if (userRole === '1') {
        return 'Admin'
      } else if (userRole === '2') {
        return 'Super Admin'
      }
    }
    
    if (users) {
      users.forEach(user => {
        tableUser.innerHTML += `
        <tr class="${user.role_as === '2' ? 'hidden' : ''}">
          <td>${user.fname}</td>
          <td>${user.lname}</td>
          <td>${user.email}</td>
          <td>${getUserRole(user.role_as)}</td>
          <td>${user.status === '0' ? 'Active' : 'Blocked'}</td>
          <td class="flex gap-1.5">
            <a 
              href="user-edit.php?id=${user.id}" 
              class="btn-primary"
            >
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1.5" 
                stroke="currentColor" 
                class="w-4 h-4"
              >
                <path 
                  stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                />
              </svg>
            edit
          </a>
          
          <?php if ($_SESSION['auth_role'] === '2') : ?>
          <button 
            id="deleteBtn" 
            value="${user.id}" 
            class="btn-red"
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-4 h-4"
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
              />
            </svg>
            delete
          </button>
          <?php endif ?>
          </td>
        </tr>
        `
      })
      addDeleteElementEvent('user');
      
    } else {
      tableUser.innerHTML = `
      <tr>
      <td rowspan="5">No records...</td>
      </tr>
      `
    }
  }
  
  fetchAllUsers().then(users => {
    showUsers(users)
    addDataTable()
  })
}

// Users add
if(pageName === 'user-add.php') {
  const formUserAdd = document.getElementById('formAddUser')

  formUserAdd.onsubmit = async (event) => {
    event.preventDefault();

    let avatarUrl = ''
    const avatar = event.target.avatar.files[0]

    if(avatar) {
      avatarUrl = await handleUpload(avatar)
    }

    const formData = new FormData();
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('cpassword', event.target.cpassword.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('status', event.target.status.checked === true ? '1' : '0')
    formData.append('role_as', event.target.role_as.value)
    formData.append('avatar', avatarUrl)

    await axios.post(endpointUsers,formData)
    .then(() => {
      window.location.href = "user-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }
}

// Users edit
if(pageName === 'user-edit.php') {
  const user_id = searchUrl.get('id')
  
  if (user_id === null || user_id === '') {
    console.log('User invalid. Please Select the user to edit')
    window.location.href = "user-view.php";
  }

  const showUserData = (user) => {
    document.getElementById('userFname').value = user.fname
    document.getElementById('userLname').value = user.lname
    document.getElementById('userEmail').value = user.email
    document.getElementById('userPassword').value = user.password
    document.getElementById('userBirth').value = user.birth
    document.querySelectorAll('#userSex').forEach(usex => {
      if (user.sex === usex.value) {
        usex.checked = true
      }
    })
    document.getElementById('userStatus').checked = user.status === '1' ? true : false
    document.getElementById('userRole').value = user.role_as
    document.getElementById('oldAvatar').value = user.avatar || ''

    toggleCheckboxValueEvent()
  }

  const formUserUpdate = document.getElementById('formUserUpdate')
  formUserUpdate.onsubmit = async (event) => {
    event.preventDefault();

    let avatarUrl = event.target.old_avatar.value
    const avatar = event.target.avatar.files[0]

    if(avatar) {
      avatarUrl = await handleUpload(avatar)
    }
    
    const formData = new FormData();
    formData.append('update_id', user_id)
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('status', event.target.status.checked === true ? '1' : '0')
    formData.append('role_as', event.target.role_as.value)
    formData.append('avatar', avatarUrl)

    try {
      await axios.post(endpointUsers, formData)
      .then(() => {
        window.location.href = "user-view.php";
      })
    } catch (err) {
      toastrAlert(err)
    }
  }
  
  fetchOneUser(user_id).then(user => {
    showUserData(user)
  })
}


/*  News Page */ 
//////////////////////////////////////////////////////////

//  News view 
if(pageName === 'news-view.php') {
  const tableNews = document.getElementById('tableNewsData')

  const showNews = (news) => {
    tableNews.innerHTML = ''

    if (news) {
      news.forEach(news => {
        tableNews.innerHTML += `
          <tr>
            <td>${news.title}</td>
            <td>${news.content}</td>
            <td>${news.status === '0' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <a 
                href="news-edit.php?id=${news.id}" 
                class="btn-primary"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="w-4 h-4"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                  />
                </svg>
                edit
              </a>
  
              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button 
                  id="deleteBtn" 
                  value="${news.id}" 
                  class="btn-red"
                >
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-4 h-4"
                  >
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
                  </svg>
                  delete
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addDeleteElementEvent('news')

    } else {
      tableNews.innerHTML = `
      <tr>
        <td rowspan="4">No records...</td>
      </tr>
      `
    }
  }
  
  fetchAllNews().then(items => {
    showNews(items)
    addDataTable()
  })
}

// Add News
if(pageName === 'news-add.php') {
  const formAddNews = document.getElementById('formAddNews')

  formAddNews.onsubmit = async (event) => {
    event.preventDefault();

    let thumbnailUrl = ''
    let fileUrl = ''

    const thumb = event.target.thumbnail.files[0]
    const file = event.target.file.files[0]

    if(thumb) {
      thumbnailUrl = await handleUpload(thumb)
    }

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const content = getContentPage();
    const slug = formatSlug(event.target.title.value)

    const formData = new FormData();
    formData.append('title', event.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('thumbnail', thumbnailUrl)
    formData.append('content', content)
    formData.append('file', fileUrl)
    formData.append('status', event.target.status.checked === true ? '1' : '0')

    await axios.post(
      endpointNews,
      formData
    ).then(() => {
      window.location.href = "news-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  addSummernote()
}

// Edit news
if(pageName === 'news-edit.php') {
  const news_id = searchUrl.get('id')

  if (news_id === null || news_id === '') {
    window.location.href = "news-view.php";
  }

  const formNewsUpdate = document.getElementById('formNewsUpdate')
  
  const showNewsData = (news) => {
    document.getElementById('title').value = news.title
    document.getElementById('oldThumbnail').value = news.thumbnail || ''
    document.getElementById('metaTitle').value = news.meta_title
    document.getElementById('contentPage').textContent = news.content
    document.getElementById('oldFile').value = news.file || ''
    document.getElementById('status').checked = news.status === '1' ? true : false

    toggleCheckboxValueEvent()

    addSummernote()
  }

  formNewsUpdate.onsubmit = async (event) => {
    event.preventDefault();

    let thumbnailUrl =  event.target.old_thumbnail.value
    let fileUrl = event.target.old_file.value

    const thumb = event.target.thumbnail.files[0]
    const file = event.target.file.files[0]

    if(thumb) {
      thumbnailUrl = await handleUpload(thumb)
    }

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const content = getContentPage();
    const slug = formatSlug(event.target.title.value)

    const formData = new FormData();
    formData.append('update_id', news_id)
    formData.append('title', event.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('thumbnail', thumbnailUrl)
    formData.append('content', content)
    formData.append('file', fileUrl)
    formData.append('status', event.target.status.checked === true ? '1' : '0')

    await axios.post(
      endpointNews,
      formData
    ).then(() => {
      window.location.href = "news-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  
  fetchOneNews(news_id).then(news => {
    showNewsData(news)
  })
}


/*  Event Page */ 
//////////////////////////////////////////////////////////

//  Event view 
if(pageName === 'event-view.php') {
  const tableEvent = document.getElementById('tableEventData')

  const showEvent = (event) => {
    tableEvent.innerHTML = ''

    if (event) {
      event.forEach(event => {
        tableEvent.innerHTML += `
          <tr>
            <td>${event.title}</td>
            <td>${event.date}</td>
            <td>${event.time}</td>
            <td>${event.location}</td>
            <td>${event.status === '0' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <a 
                href="event-edit.php?id=${event.id}" 
                class="btn-primary"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="w-4 h-4"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                  />
                </svg>
                edit
              </a>
  
              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button 
                  id="deleteBtn" 
                  value="${event.id}" 
                  class="btn-red"
                >
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-4 h-4"
                  >
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
                  </svg>
                  delete
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addDeleteElementEvent('event')

    } else {
      tableEvent.innerHTML = `
      <tr>
        <td rowspan="4">No records...</td>
      </tr>
      `
    }
  }
  
  fetchAllEvents().then(event => {
    showEvent(event)
    addDataTable()
  })
}


// Add Event
if(pageName === 'event-add.php') {
  const formAddEvent = document.getElementById('formAddEvent')

  formAddEvent.onsubmit = async (ev) => {
    ev.preventDefault();

    let fileUrl = ''
    const file = ev.target.file.files[0]

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const content = getContentPage();
    const time = getEventTimeInterval()
    const slug = formatSlug(ev.target.title.value)

    const formData = new FormData();
    formData.append('title', ev.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', ev.target.meta_title.value)
    formData.append('date', ev.target.date.value)
    formData.append('location', ev.target.location.value)
    formData.append('time', time)
    formData.append('content', content)
    formData.append('file', fileUrl)
    formData.append('status', ev.target.status.checked === true ? '1' : '0')

    await axios.post(
      endpointEvents,
      formData
    ).then(() => {
      window.location.href = "event-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  addSummernote()
}

// Edit Event
if(pageName === 'event-edit.php') {
  const event_id = searchUrl.get('id')

  if (event_id === null || event_id === '') {
    window.location.href = "event-view.php";
  }

  const formUpdateEvent = document.getElementById('formUpdateEvent')

  const showEventData = (event) => {
    const time = event.time.split(' - ')

    document.getElementById('title').value = event.title
    document.getElementById('metaTitle').value = event.meta_title
    document.getElementById('date').value = event.date
    document.getElementById('location').value = event.location
    document.getElementById('timeStart').value = time[0]
    document.getElementById('timeEnd').value = time[1]
    document.getElementById('contentPage').textContent = event.content
    document.getElementById('oldFile').value = event.file || ''
    document.getElementById('status').checked = event.status === '1' ? true : false

    toggleCheckboxValueEvent()

    addSummernote()
  }

  formUpdateEvent.onsubmit = async (ev) => {
    ev.preventDefault();

    let fileUrl = ev.target.old_file.value
    const file = ev.target.file.files[0]

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const content = getContentPage();
    const time = getEventTimeInterval()
    const slug = formatSlug(ev.target.title.value)

    const formData = new FormData();
    formData.append('update_id', event_id)
    formData.append('title', ev.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', ev.target.meta_title.value)
    formData.append('date', ev.target.date.value)
    formData.append('location', ev.target.location.value)
    formData.append('time', time)
    formData.append('content', content)
    formData.append('file', fileUrl)
    formData.append('status', ev.target.status.checked === true ? '1' : '0')


    await axios.post(
      endpointEvents,
      formData
    ).then(() => {
      window.location.href = "event-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  fetchOneEvent(event_id).then(event => {
    showEventData(event)
  })
}


/*  Newsletter Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'newsletter-view.php') {
  const formSub = document.getElementById('formSub');

  const showSubscriptions = (subs) => {
    const tableSub = document.getElementById('tableSub')
    tableSub.innerHTML = ''

    if (subs) {
      subs.forEach(sub => {
        tableSub.innerHTML += `
          <tr>
            <td>${sub.email}</td>
            <td>${sub.status === '0' ? 'active' : 'inactive'}</td>
            <td class="flex gap-1.5">
              <button 
                id="editBtn" 
                value="${sub.id}" 
                class="btn-primary"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="w-4 h-4"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                  />
                </svg>
                edit
              </button>

              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button 
                  id="deleteBtn" 
                  value="${sub.id}" 
                  class="btn-red"
                >
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-4 h-4"
                  >
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
                  </svg>
                  unsubscribe
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addEditElementEvent('newsletter')
      addDeleteElementEvent('newsletter')

    } else {
      tableSub.innerHTML = `
        <tr>
          <td rowspan="4">No records...</td>
        </tr>
      `
    }
  }

  fetchAllSubscriptions().then(subs => {
    showSubscriptions(subs)
    addDataTable()
  })

  // Subscribe User
  formSub.onsubmit = async (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append('email', event.target.email.value)
    formData.append('status', event.target.status.checked === true ? '1' : '0')

    await axios.post(endpointNewsletter,formData)
    .then(() => {
      // formSub.reset()
      // fetchAllSubscriptions();
      location.reload()
    }).catch(err => {
      toastrAlert(err)
    })
  }


  // Edit Subscription
  function showSubscriptionToEdit(sub) {
    window.location.href = "#"
    const subEmail = document.getElementById("subEmail")

    document.getElementById("editLabel").innerText = `Edit user ${sub.email}`
    
    subEmail.value = sub.email
    subEmail.disabled = true
    subEmail.classList.add('opacity-50')

    document.getElementById("subStatus").checked = sub.status === '1' ? true : false
    document.getElementById("subBtnSave").innerText = "Update"
    subBtnCancel.classList.remove('hidden')
    subBtnCancel.onclick = () => {
      location.reload()
    }

    toggleCheckboxValueEvent()

    formSub.onsubmit = async (event) => {
      event.preventDefault();

      const formData = new FormData();
      formData.append('update_id', sub.id)
      formData.append('status', event.target.status.checked === true ? '1' : '0')

      await axios.post(endpointNewsletter, formData)
      .then(res => {
        // formSub.reset()
        // fetchAllCats();
        location.reload()
      }).catch(err => {
        toastrAlert(err)
      })
    }
  }
}

/*  Categories Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'category-view.php') {
  const formCat = document.getElementById('formCat');

  const showCats = (cats) => {
    const tableCat = document.getElementById('tableCatData')
    tableCat.innerHTML = ''

    if (cats) {
      cats.forEach(cat => {
        tableCat.innerHTML += `
          <tr>
            <td>${cat.name}</td>
            <td>${cat.parent_name !== null ? cat.parent_name : ''}</td>
            <td>${cat.status === '0' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <button 
                id="editBtn" 
                value="${cat.id}" 
                class="btn-primary"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="w-4 h-4"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                  />
                </svg>
                edit
              </button>

              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button 
                  id="deleteBtn" 
                  value="${cat.id}" 
                  class="btn-red"
                >
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-4 h-4"
                  >
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
                  </svg>
                  delete
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addEditElementEvent('cat')
      addDeleteElementEvent('cat')

    } else {
      tableCat.innerHTML = `
        <tr>
          <td rowspan="4">No records...</td>
        </tr>
      `
    }
  }

  fetchAllCats().then(cats => {
    showCats(cats)
    showSelCatOptions(cats)
    addDataTable()
  })

  // Add Category
  formCat.onsubmit = async (event) => {
    event.preventDefault();

    let logoUrl = ''
    const logo = event.target.logo.files[0]

    if(logo) {
      logoUrl = await handleUpload(logo)
    }

    const slug = formatSlug(event.target.title.value)

    const formData = new FormData();
    formData.append('name', event.target.name.value)
    formData.append('parent_category_id', event.target.parent_category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', slug)
    formData.append('navbar_status', event.target.navbar_status.checked === true ? '1' : '0')
    formData.append('logo', logoUrl)

    await axios.post(endpointCategories, formData)
    .then(() => {
      // formCat.reset()
      // fetchAllCats();
      location.reload()
    }).catch(err => {
      toastrAlert(err)
    })
  }

  // Edit Category
  function showCatToEdit(cat) {
    window.location.href = "#"

    document.getElementById("catLabel").innerText = `Edit category ${cat.name}`
    document.getElementById("catName").value = cat.name
    document.getElementById("selectCat").value = cat.parent_category_id
    document.getElementById("catTitle").value = cat.title
    document.getElementById("catStatus").checked = cat.navbar_status === '1' ? true : false
    document.getElementById("catBtnSave").innerText = "Update"
    catBtnCancel.classList.remove('hidden')
    catBtnCancel.onclick = () => {
      location.reload()
    }

    toggleCheckboxValueEvent()

    formCat.onsubmit = async (event) => {
      event.preventDefault();

      let logoUrl = cat.logo || ''
      const logo = event.target.logo.files[0]

      if(logo) {
        logoUrl = await handleUpload(logo)
      }

      const slug = formatSlug(event.target.title.value)

      const formData = new FormData();
      formData.append('update_id', cat.id)
      formData.append('name', event.target.name.value)
      formData.append('parent_category_id', event.target.parent_category_id.value)
      formData.append('title', event.target.title.value)
      formData.append('slug', slug)
      formData.append('navbar_status', event.target.navbar_status.checked === true ? '1' : '0')
      formData.append('logo', logoUrl)

      await axios.post(endpointCategories, formData)
      .then(() => {
        // formCat.reset()
        // fetchAllCats();
        location.reload()
      }).catch(err => {
        toastrAlert(err)
      })
    }
  }
}


/*  Items Page */ 
//////////////////////////////////////////////////////////

//  Items view 
if(pageName === 'item-view.php') {
  const tableItem = document.getElementById('tableItemData')

  const showItems = (items) => {
    tableItem.innerHTML = ''

    if (items) {
      items.forEach(item => {
        tableItem.innerHTML += `
          <tr>
            <td>${item.name}</td>
            <td>${item.title}</td>
            <td>${item.category_name}</td>
            <td>${item.status === '0' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <a 
                href="item-edit.php?id=${item.id}" 
                class="btn-primary"
              >
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor" 
                  class="w-4 h-4"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                  />
                </svg>
                edit
              </a>
  
              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button 
                  id="deleteBtn" 
                  value="${item.id}" 
                  class="btn-red"
                >
                  <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-4 h-4"
                  >
                    <path 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
                  </svg>
                  delete
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addDeleteElementEvent('item')

    } else {
      tableItem.innerHTML = `
      <tr>
        <td rowspan="5">No records...</td>
      </tr>
      `
    }
  }
  
  fetchAllItems().then(items => {
    showItems(items)
    addDataTable()
  })
}

// Add Items
if(pageName === 'item-add.php') {
  const formAddItem = document.getElementById('formAddItem')

  addContentItemEvent()
  removeContentItemEvent()

  formAddItem.onsubmit = async (event) => {
    event.preventDefault();

    let logoUrl = ''
    let fileUrl = ''

    const logo = event.target.logo.files[0]
    const file = event.target.file.files[0]

    if(logo) {
      logoUrl = await handleUpload(logo)
    }

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const data_content = getItemDataContent();
    const slug = formatSlug(event.target.title.value)

    const formData = new FormData();
    formData.append('name', event.target.name.value)
    formData.append('category_id', event.target.category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('logo', logoUrl)
    formData.append('data_content', JSON.stringify(data_content))
    formData.append('file', fileUrl)
    formData.append('status', event.target.status.checked === true ? '1' : '0')

    await axios.post(endpointItems, formData)
    .then(() => {
      window.location.href = "item-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  addSummernote()

  fetchAllCats().then(cats => {
    showSelCatOptions(cats);
  })
}

// Edit items
if(pageName === 'item-edit.php') {
  const item_id = searchUrl.get('id')

  if (item_id === null || item_id === '') {
    console.log('Invalid item. Please Select the item to edit')
    window.location.href = "item-view.php";
  }

  const formItemUpdate = document.getElementById('formItemUpdate')
  const items = document.getElementById('items')
  
  const showItemData = (item) => {
    const data_content = JSON.parse(item.data_content)
    items.innerHTML = ''

    document.getElementById('name').value = item.name
    document.getElementById('selectCat').value = item.category_id
    document.getElementById('title').value = item.title
    document.getElementById('metaTitle').value = item.meta_title
    document.getElementById('oldLogo').value = item.logo
    document.getElementById('status').checked = item.status === '1' ? true : false
    document.getElementById('oldFile').value = item.file

    toggleCheckboxValueEvent()

    data_content.forEach(data => {
      items.innerHTML += contentItemElement(data.title, data.description)
    })
    addSummernote()
    addContentItemEvent()
    removeContentItemEvent()
  }

  formItemUpdate.onsubmit = async (event) => {
    event.preventDefault();

    let logoUrl =  event.target.old_logo.value
    let fileUrl = event.target.old_file.value

    const logo = event.target.logo.files[0]
    const file = event.target.file.files[0]

    if(logo) {
      logoUrl = await handleUpload(logo)
    }

    if(file) {
      fileUrl = await handleUpload(file)
    }

    const data_content = getItemDataContent();
    const slug = formatSlug(event.target.title.value)

    const formData = new FormData();
    formData.append('update_id', item_id)
    formData.append('name', event.target.name.value)
    formData.append('category_id', event.target.category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', slug)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('logo', logoUrl)
    formData.append('data_content', JSON.stringify(data_content))
    formData.append('status', event.target.status.checked === true ? '1' : '0')
    formData.append('file', fileUrl)

    await axios.post(endpointItems, formData)
    .then(() => {
      window.location.href = "item-view.php";
    }).catch(err => {
      toastrAlert(err)
    })
  }

  fetchAllCats().then(cats => {
    showSelCatOptions(cats)

    fetchOneItem(item_id).then(item => {
      showItemData(item)
    })
  })
}