<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mt-4 md:mt-10 w-full flex justify-center py-3 bg-[#089101]  border border-transparent rounded-md font-semibold text-sm md:text-base  text-white uppercase tracking-widest hover:bg-[#44c044] focus:bg-[#44c044] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
