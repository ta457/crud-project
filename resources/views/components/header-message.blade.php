@if (session('success'))
<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
  class="text-emerald-500 md:inline md:ml-8">{{ __(session('success')) }}</p>
@endif
@if (session('error'))
<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
  class="text-rose-500 md:inline md:ml-8">{{ __(session('error')) }}</p>
@endif