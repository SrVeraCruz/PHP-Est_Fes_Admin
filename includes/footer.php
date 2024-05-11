  </main>
</div>

<footer class="mt-auto sticky flex justify-between text-sm p-4 py-8 border-t-2">
  <div>
    <p class="text-dark/60">Copyright &COPY; Est Fes <span id="Date-copy">2024</span></p>
  </div>
  <div>
    <ul class="flex gap-1 text-blue-600 ">
      <li><a href="#" class="underline" >Privacy Policy</a></li>·
      <li><a href="#" class="underline" >Terms & Conditions</a></li>
    </ul>
  </div>
</footer>

<script>
  const handleAddItem = () => {
    // const summernoteId = `summernote${Date.now()}`;

    const listItem = document.getElementById('items');

    const item = document.createElement('div')
    
    const deleteBtn = document.createElement('button');
    const span1 = document.createElement('span');
    const span2 = document.createElement('span');
    deleteBtn.setAttribute('type','button')
    deleteBtn.setAttribute('id','delItem')
    deleteBtn.appendChild(span1)
    deleteBtn.appendChild(span2)
    deleteBtn.onclick = (event) => {
      handleDeleteItem(event)
    }
    
    const stitleDiv = document.createElement('div')
    stitleDiv.setAttribute('id','element')
    const stitleLabel = document.createElement('label')
    const stitleInput = document.createElement('input')
    
    const descDiv = document.createElement('div')
    descDiv.setAttribute('id','element')
    const descLabel = document.createElement('label')
    const decTextarea = document.createElement('textarea')
    
    item.setAttribute('id','item')
    stitleLabel.textContent = 'Sub-title:'
    descLabel.textContent = 'Description:'
    stitleInput.setAttribute('placeholder','e.g: Presentation')
    stitleInput.setAttribute('name','data_content_title[]')

    decTextarea.setAttribute('name','data_content_desc[]')
    decTextarea.classList.add('summernote')

    stitleDiv.appendChild(stitleLabel)
    stitleDiv.appendChild(stitleInput)
    descDiv.appendChild(descLabel)
    descDiv.appendChild(decTextarea)
    
    item.appendChild(deleteBtn)
    item.appendChild(stitleDiv)
    item.appendChild(descDiv)

    listItem.appendChild(item)

    addSummernote()
  }

  const addSummernote = () => {
    $('.summernote').summernote({
      placeholder: 'e.g: Le diplomé de la filière Génie Informatique',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  }

  const handleDeleteItem = (event) => {
    event.target.parentElement.parentElement.remove()
  }

  window.onload = () => {
    addSummernote()
  }

</script>

</body>
</html>