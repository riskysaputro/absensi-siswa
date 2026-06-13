<div class="p-6">


    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 p-6 rounded-2xl text-white mb-6">


        <h1 class="text-3xl font-bold">

            Beri Akses Pengguna

        </h1>


        <p class="text-indigo-100">

            Atur hak akses setiap role

        </p>


    </div>




    <div class="bg-white shadow rounded-2xl p-6">



        <label class="font-semibold">

            Pilih Role

        </label>


        <select wire:model.live="roleId" class="w-full mt-2 border rounded-xl p-2">


            <option value="">

                -- Pilih Role --

            </option>


            @foreach ($roles as $role)
                <option value="{{ $role->id }}">

                    {{ $role->name }}

                </option>
            @endforeach


        </select>





        @if ($roleId)


            <hr class="my-6">


            <h2 class="font-bold text-lg mb-4">

                Hak Akses Pengguna

            </h2>




            <div class="grid md:grid-cols-3 gap-4">


                @foreach ($allPermissions as $permission)
                    <label class="flex items-center gap-3 border rounded-xl p-3 hover:bg-gray-50">


                        <input type="checkbox" wire:model="permissions" value="{{ $permission->name }}" class="rounded">


                        <span>

                            {{ $permission->name }}

                        </span>



                    </label>
                @endforeach


            </div>




            <button wire:click="save" class="mt-6 bg-indigo-600 text-white px-5 py-2 rounded-xl hover:bg-indigo-700">


                Simpan Hak Akses


            </button>



        @endif



    </div>


</div>
