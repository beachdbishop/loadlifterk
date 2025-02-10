<?php

/**
 * Custom Search Form
 */
?>

<search>
	<form action="/" method="get">
		<div class="relative font-normal">
			<label for="search" class="sr-only"> Search </label>
			<input
				type="text"
				id="search"
				name="s"
				placeholder="Search for..."
				class="w-full placeholder:text-neutral-600 py-2.5 pe-10 shadow-xs  |  dark:placeholder:text-neutral-400 sm:text-base"
				value="<?php the_search_query(); ?>" />
			<span class="absolute inset-y-0 grid w-10 end-0 place-content-center ">
				<button type="submit" class="text-neutral-800  |  hover:text-aqua-500 dark:text-neutral-300">
					<span class="sr-only">Search</span>
					<i class="fa-regular fa-magnifying-glass"></i>
				</button>
			</span>
		</div>
	</form>
</search>
