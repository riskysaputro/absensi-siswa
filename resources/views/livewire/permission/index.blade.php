<div class="p-6">


<div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-6 text-white mb-6">

    <h1 class="text-3xl font-bold">
        Role & Permission
    </h1>

    <p class="text-indigo-100 mt-2">
        Pengaturan hak akses pengguna sistem
    </p>

</div>



<div class="grid md:grid-cols-3 gap-6">


@foreach($roles as $role)


<div class="bg-white shadow rounded-2xl p-6">


<div class="flex justify-between items-center mb-4">


<h2 class="text-xl font-bold">

{{ $role->name }}

</h2>


<span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">

{{ $role->permissions->count() }}
Permission

</span>


</div>




<h3 class="font-semibold mb-2">
Permission:
</h3>


<div class="flex flex-wrap gap-2 mb-5">


@forelse($role->permissions as $permission)


<span
class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

{{ $permission->name }}

</span>


@empty


<span class="text-gray-400">

Belum ada permission

</span>


@endforelse


</div>





<h3 class="font-semibold mb-2">
User:
</h3>



<ul class="space-y-2">


@forelse($role->users as $user)


<li class="flex items-center gap-2">


<div
class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">

{{ substr($user->name,0,1) }}

</div>


<span>

{{ $user->name }}

</span>


</li>



@empty


<li class="text-gray-400">

Belum ada user

</li>


@endforelse


</ul>



</div>



@endforeach


</div>


</div>
