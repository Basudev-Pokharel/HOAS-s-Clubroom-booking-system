      <div class="w-full flex justify-center items-center mt-2">
          <button
              class="flex gap-2 bg-[#1059c0] text-white p-2 rounded-sm text-center hover:bg-[#6f9ee0] cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
              </svg>
              <h2>Key Info</h2>
          </button>
      </div>

      {{-- // Modal begins here --}}
      <div class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4 backdrop-blur-xl" role="dialog"
          aria-modal="true" aria-labelledby="modalTitle">
          <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
              <h2 id="modalTitle" class="text-xl font-bold text-gray-900 sm:text-2xl">Keys Information</h2>
              <div class="mt-4">
                  <p class="text-pretty text-gray-700">
                      Your room key doesn't work in the clubroom. You have to contact the local committee member who has
                      the keys. below are their details.
                  </p>
                  @php
                      echo $key_peoples ?? 'not';
                  @endphp
                  @if (!empty($key_peoples))
                      @foreach ($key_peoples as $people)
                          <div class="">
                              <h2>{{ $people->name }}</h2>
                              <h3>{{ $people->whatsapp }}</h3>
                          </div>
                      @endforeach
                  @else
                      <h3 class="text-red-500 font-bold">No person found with key</h3>
                  @endif
              </div>

              <footer class="mt-6 flex justify-end gap-2">
                  <button type="button"
                      class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-blue-700">
                      Done
                  </button>
              </footer>
          </div>
      </div>
      {{-- //Modal ends here --}}

      <script>
          //   let 
      </script>
