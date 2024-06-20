/* Global Variables */ 
const baseUrl = 'http://localhost/EST_FES_SITE/admin_est-usmba.ac.ma/';
const endpointLogin = `${baseUrl}api/users/login`;
const endpointLogout = `${baseUrl}api/users/logout`;
const endpointRegister = `${baseUrl}api/users/register`;
const endpointUsers = `${baseUrl}api/users`;
const endpointCategories = `${baseUrl}api/categories`;
const endpointItems = `${baseUrl}api/items`;

const searchUrl = new URLSearchParams(window.location.search)
const pageUrl = location.pathname
const pageName = pageUrl.substring(pageUrl.lastIndexOf("/") + 1)

const navbar_hamburguer = document.getElementById("navbar-hamburguer");
const aside = document.getElementById("aside");

const confirmDelBox = document.getElementById("confirmDelBox");
const pageIndicator = document.getElementById("pageIndicator");
const cancelDeleteBtn = document.getElementById('cancelDelete')
const sideOutDelete = document.getElementById("sideOutDelete");


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

const unshowCancelDelete = () => {
  confirmDelBox.classList.replace('flex', 'hidden');
  sideOutDelete.classList.add("hidden");
  pageIndicator.removeChild(pageIndicator.lastElementChild)
}

const showDeleteBox = () => {
  confirmDelBox.classList.replace('hidden', 'flex');
  sideOutDelete.classList.remove("hidden");
  pageIndicator.innerHTML += `
    <li>
      <a href="#">Delete</a>
    </li>
  `
}

const addDeleteElementEvent = (name) => {
  document.querySelectorAll("#deleteBtn").forEach(btn => {
    btn.onclick = () => {
      showDeleteBox()
      switch(name) {
        case 'user':
          handleDeleteUser(btn.value)
          break
        case 'cat':
          handleDeleteCat(btn.value)
          break
        case 'item':
          handleDeleteItem(btn.value)
          break
        default:
          console.log('invalid delete event name')
          break
      }
    }
  })
}

const toggleCheckboxValueEvent = () => {
  document.querySelectorAll('input[type="checkbox"]').forEach(cbox => {
    cbox.onclick = () => {
      cbox.value = cbox.checked === true ? 'on' : 'off'
    }
  })
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
 
if(cancelDeleteBtn && sideOutDelete) {
  cancelDeleteBtn.onclick = () => {
    unshowCancelDelete()
  }

  sideOutDelete.onclick = () => {
    unshowCancelDelete()
  }
}

/* Register Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'register.php') {
  const formUserRegister = document.getElementById('formUserRegister')

  formUserRegister.onsubmit = async (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('cpassword', event.target.cpassword.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('avatar', event.target.avatar.files[0])
    
    await axios.post(
      endpointRegister,
      formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    ).then(res => {
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
    .then(res => {
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
      .then(res => {
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
          <td class="flex gap-1.5">
            <a href="user-edit.php?id=${user.id}" class="btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
            edit
          </a>
          
          <?php if ($_SESSION['auth_role'] === '2') : ?>
          <button id="deleteBtn" value="${user.id}" class="btn-red">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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

  // Users delete
  const formConfirmUserDelete = document.getElementById("formConfirmUserDelete")

  function handleDeleteUser(id) {
    fetchOneUser(id).then(user => {
      showUserToDelete(user)
    });
  }

  const showUserToDelete = (user) => {
    document.getElementById("confirmDelUserName").innerHTML = user.fname + '&nbsp;' + user.lname
    document.getElementById("confirmDelUserRole").value = user.role_as
    document.getElementById("confirmDelUserAvatar").value = user.avatar
    document.getElementById("confirmDelUserId").value = user.id
  }
  
  formConfirmUserDelete.onsubmit = async (event) => {
    event.preventDefault()
    
    const formData = new FormData()
    formData.append("delete_user_id", event.target.confirmDelUserId.value)
    formData.append("role_as", event.target.confirmDelUserRole.value)
    formData.append("avatar", event.target.confirmDelUserAvatar.value)
    
    await axios.post(endpointUsers, formData)
    .then(res => {
      // unshowCancelDelete()
      // fetchAllUsers()
      location.reload();
    })
    .catch(err => {
      toastrAlert(err)
    })
  }
}

// Users add
if(pageName === 'user-add.php') {
  const formUserAdd = document.getElementById('formAddUser')

  formUserAdd.onsubmit = async (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('cpassword', event.target.cpassword.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('status', event.target.status.value === 'on' ? '1' : '0')
    formData.append('role_as', event.target.role_as.value)
    formData.append('avatar', event.target.avatar.files[0])

    await axios.post(
      endpointUsers,
      formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    ).then(res => {
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
    document.getElementById('userId').value = user.id
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
    document.getElementById('userAvatarOldName').value = user.avatar

    toggleCheckboxValueEvent()
  }

  const formUserUpdate = document.getElementById('formUserUpdate')
  formUserUpdate.onsubmit = async (event) => {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('update_user_id', event.target.user_id.value)
    formData.append('fname', event.target.fname.value)
    formData.append('lname', event.target.lname.value)
    formData.append('email', event.target.email.value)
    formData.append('password', event.target.password.value)
    formData.append('birth', event.target.birth.value)
    formData.append('sex', event.target.sex.value)
    formData.append('status', event.target.status.value === 'on' ? '1' : '0')
    formData.append('role_as', event.target.role_as.value)
    formData.append('avatar_old_name', event.target.avatar_old_name.value)
    formData.append('avatar', event.target.avatar.files[0])

    try {
      await axios.post(
        endpointUsers,
        formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      ).then(res => {
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


/*  Categories Page */ 
//////////////////////////////////////////////////////////
if(pageName === 'category-view.php') {
  const formCat = document.getElementById('formCat');
  const FormConfirmCatDelete = document.getElementById('FormConfirmCatDelete');

  const showCats = (cats) => {
    const tableCat = document.getElementById('tableCatData')
    tableCat.innerHTML = ''

    if (cats) {
      cats.forEach(cat => {
        tableCat.innerHTML += `
        <tr">
            <td>${cat.name}</td>
            <td>${cat.parent_name !== null ? cat.parent_name : ''}</td>
            <td>${cat.status === '1' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <button id="editCatBtn" value="${cat.id}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                edit
              </button>

              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button id="deleteBtn" value="${cat.id}" class="btn-red">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                  </svg>
                  delete
                </button>
              <?php endif ?>
            </td>
          </tr>
        `
      })
      addEditCatEvent()
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

    const formData = new FormData();
    formData.append('name', event.target.name.value)
    formData.append('parent_category_id', event.target.parent_category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', event.target.slug.value)
    formData.append('navbar_status', event.target.navbar_status.value === 'on' ? '1' : '0')
    formData.append('logo', event.target.logo.files[0])

    await axios.post(
      endpointCategories,
      formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    ).then(res => {
      formCat.reset()
      fetchAllCats();
    }).catch(err => {
      toastrAlert(err)
    })
  }

  // Edit Category
  const addEditCatEvent = () => {
    document.querySelectorAll('#editCatBtn').forEach(btn => {
      btn.onclick = () => {
        handleEditCat(btn.value)
      }
    })
  }

  const handleEditCat = (id) => {
    pageIndicator.innerHTML += `
      <li>
        <a href="#">Edit</a>
      </li>
    `
    fetchOneCat(id).then(cat => {
      showCatToEdit(cat)
    })
  }

  const showCatToEdit = (cat) => {
    window.location.href = "#"

    document.getElementById("catLabel").innerText = `Edit category ${cat.name}`
    document.getElementById("catName").value = cat.name
    document.getElementById("selectCat").value = cat.parent_category_id
    document.getElementById("catTitle").value = cat.title
    document.getElementById("catSlug").value = cat.slug
    document.getElementById("catStatus").checked = cat.navbar_status === '1' ? true : false
    document.getElementById("catBtnSave").innerText = "Update"
    catBtnCancel.classList.remove('hidden')
    catBtnCancel.onclick = () => {
      location.reload()
    }

    toggleCheckboxValueEvent()

    formCat.onsubmit = async (event) => {
      event.preventDefault();

      const formData = new FormData();
      formData.append('update_cat_id', cat.id)
      formData.append('name', event.target.name.value)
      formData.append('parent_category_id', event.target.parent_category_id.value)
      formData.append('title', event.target.title.value)
      formData.append('slug', event.target.slug.value)
      formData.append('navbar_status', event.target.navbar_status.value === 'on' ? '1' : '0')
      formData.append('logo_old_name', cat.logo)
      formData.append('logo', event.target.logo.files[0])

      await axios.post(
        endpointCategories,
        formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      ).then(res => {
        // formCat.reset()
        // fetchAllCats();
        location.reload()
      }).catch(err => {
        toastrAlert(err)
      })
    }
  }

  // Delete Category
  const showCatToDelete = (cat) => {
    document.getElementById("confirmDelCatName").innerText = cat.name
    document.getElementById("confirmDelCatLogo").value = cat.logo
    document.getElementById("confirmDelCatId").value = cat.id
  }

  function handleDeleteCat(id) {
    fetchOneCat(id).then(cat => {
      showCatToDelete(cat)
    })
  }

  FormConfirmCatDelete.onsubmit = async (event) => {
    event.preventDefault()

    const formData = new FormData()
    formData.append("delete_cat_id", event.target.delete_cat_id.value)
    formData.append("logo", event.target.delete_cat_logo.value)

    await axios.post(endpointCategories, formData)
      .then(res => {
        // unshowCancelDelete()
        // fetchAllCats()
        location.reload();
      })
      .catch(err => {
        toastrAlert(err)
      })
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
        <tr class="${item.role_as === '2' ? 'hidden' : ''}">
            <td>${item.name}</td>
            <td>${item.title}</td>
            <td>${item.category_name}</td>
            <td>${item.status === '1' ? 'visible' : 'hidden'}</td>
            <td class="flex gap-1.5">
              <a href="item-edit.php?id=${item.id}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                edit
              </a>
  
              <?php if ($_SESSION['auth_role'] === '2') : ?>
                <button id="deleteBtn" value="${item.id}" class="btn-red">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
  
  // Delete Items
  const FormConfirmItemDelete = document.getElementById("FormConfirmItemDelete")

  function handleDeleteItem(id) {
    fetchOneItem(id).then(item => {
      showItemToDelete(item)
    });
  }

  const showItemToDelete = (item) => {
    document.getElementById("confirmDelItemName").innerText = item.name
    document.getElementById("confirmDelItemLogo").value = item.logo
    document.getElementById("confirmDelItemFile").value = item.file
    document.getElementById("confirmDelItemId").value = item.id
  }

  FormConfirmItemDelete.onsubmit = async (event) => {
    event.preventDefault()

    const formData = new FormData()
    formData.append("delete_item_id", event.target.delete_item_id.value)
    formData.append("logo", event.target.delete_item_logo_name.value)
    formData.append("file", event.target.delete_item_file_name.value)

    await axios.post(endpointItems, formData)
      .then(res => {
        // unshowCancelDelete()
        // fetchAllItems()
        location.reload();
      })
      .catch(err => {
        toastrAlert(err)
      })
  }

}

// Add Items
if(pageName === 'item-add.php') {
  const formAddItem = document.getElementById('formAddItem')

  addContentItemEvent()
  removeContentItemEvent()
  

  formAddItem.onsubmit = async (event) => {
    event.preventDefault();

    const data_content = getItemDataContent();

    const formData = new FormData();
    formData.append('name', event.target.name.value)
    formData.append('category_id', event.target.category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', event.target.slug.value)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('logo', event.target.logo.files[0])
    formData.append('data_content', JSON.stringify(data_content))
    formData.append('file', event.target.file.files[0])
    formData.append('status', event.target.status.value === 'on' ? '1' : '0')

    await axios.post(
      endpointItems,
      formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    ).then(res => {
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
    document.getElementById('slug').value = item.slug
    document.getElementById('metaTitle').value = item.meta_title
    document.getElementById('logoOldName').value = item.logo
    document.getElementById('status').checked = item.status === '1' ? true : false
    document.getElementById('fileOldName').value = item.file

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

    const data_content = getItemDataContent();

    const formData = new FormData();
    formData.append('update_item_id', item_id)
    formData.append('name', event.target.name.value)
    formData.append('category_id', event.target.category_id.value)
    formData.append('title', event.target.title.value)
    formData.append('slug', event.target.slug.value)
    formData.append('meta_title', event.target.meta_title.value)
    formData.append('logo_old_name', event.target.logo_old_name.value)
    formData.append('logo', event.target.logo.files[0])
    formData.append('data_content', JSON.stringify(data_content))
    formData.append('status', event.target.status.value === 'on' ? '1' : '0')
    formData.append('file_old_name', event.target.file_old_name.value)
    formData.append('file', event.target.file.files[0])

    await axios.post(
      endpointItems,
      formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }
    ).then(res => {
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