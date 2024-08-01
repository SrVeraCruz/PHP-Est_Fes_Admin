<?php
  $page = substr(
    $_SERVER['SCRIPT_NAME'], 
    strrpos($_SERVER['SCRIPT_NAME'], '/') + 1
  );
?>

<?php if (isset($_SESSION['auth'])) : ?>
  <aside 
    id="aside"
    class="fixed top-[4.7rem] md:bottom-0 p-4 md:w-full
      md:-translate-x-full bg-bgGray text-dark/75
      md:transition z-40 h-[calc(100vh-4.7rem)]
      overflow-y-auto 
    "
  >
    <div>
      <ul class="flex flex-col gap-3">

        <li>
          <a 
            href="index.php" 
            class="flex gap-1 p-1 pr-16 rounded-md group
              <?= 
                $page === 'index.php'
                ? 'bg-highlight'
                : 'hover:bg-highlight/30'
              ?> 
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= $page === 'index.php' ? 'text-primary' : '' ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" 
              />
            </svg>
            Dashboard
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

        <li>
          <a 
            href="user-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'user-view.php' || 
                $page === 'user-add.php' || 
                $page === 'user-edit.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5"
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'user-view.php' || 
                  $page === 'user-add.php' || 
                  $page === 'user-edit.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" 
              />
            </svg>
            Users
          </a>
        </li>

        <li>
          <a 
            href="request-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'request-view.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'request-view.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" 
              />
            </svg>
            Requests
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

                <li>
          <a 
            href="category-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md group 
              <?= 
                $page === 'category-view.php' || 
                $page === 'category-add.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'category-view.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" 
              />
            </svg>
            Categories
          </a>
        </li>

        <li>
          <a 
            href="item-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'item-view.php' || 
                $page === 'item-add.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'item-view.php' || 
                  $page === 'item-add.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" 
              />
            </svg>
            Items
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

        <li>
          <a 
            href="slide-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'slide-view.php' || 
                $page === 'slide-add.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'slide-view.php' || 
                  $page === 'slide-add.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z" 
              />
            </svg>

            Slides
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

        <li>
          <a 
            href="news-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'news-view.php' ||
                $page === 'news-add.php' || 
                $page === 'news-edit.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'news-view.php' ||
                  $page === 'news-add.php' || 
                  $page === 'news-edit.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" 
              />
            </svg>
            News
          </a>
        </li>
        
        <li>
          <a 
            href="event-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'event-view.php' ||
                $page === 'event-add.php' || 
                $page === 'event-edit.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'event-view.php' ||
                  $page === 'event-add.php' || 
                  $page === 'event-edit.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" 
              />
            </svg>
            Events
          </a>
        </li>
       
        <li>
          <a 
            href="newsletter-view.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'newsletter-view.php'
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'newsletter-view.php'
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" 
              />
            </svg>
            Newsletter
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

        <li>
          <a 
            href="setting.php" 
            class="flex gap-1 p-1 pr-16 rounded-md  group 
              <?= 
                $page === 'setting.php' 
                ? 'bg-highlight' : 'hover:bg-highlight/30' 
              ?>
            "
          >
            <svg 
              xmlns="http://www.w3.org/2000/svg" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke-width="1.5" 
              stroke="currentColor" 
              class="w-6 h-6 group-hover:text-primary 
                <?= 
                  $page === 'setting.php' 
                  ? 'text-primary' : '' 
                ?>
              "
            >
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" 
              />
              <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" 
              />
            </svg>
            Settings
          </a>
        </li>

        <span class="bg-highlight w-full h-[.07rem]"></span>

        <li>
          <form id="logoutForm">
            <button 
              type="submit" 
              name="logout_btn" 
              class="flex gap-1 p-1 pr-16 rounded-md group"
            >
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24"
                stroke-width="1.5" 
                stroke="currentColor" 
                class="w-6 h-6 group-hover:text-red-500"
              >
                <path 
                  stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" 
                />
              </svg>
              Logout
            </button>
          </form>
        </li>

      </ul>
    </div>
  </aside>
<?php endif ?>