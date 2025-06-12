# Why .html files in here?

Use to embed **Synced Patterns** created/modified in the Block Editor within the _Block Editor_ AND _PHP templates_! 

1. Create new HTML file in `theme/parts/`. Name in all lowercase, i.e. `img-grid-assoc-construction.html`. This is is a new Template Part. Make note of the file slug. Stage. Commit. Push to other environments.
1. Create new Synced Pattern*. Sure, use a naming scheme you sly dog.
1. Populate relevant blocks and **Publish** it. _Note:_ You do not need to 'Convert to block pattern' for this to work. (You can then export as JSON in order to import the same blocks in other environments.)
1. From _Appearance_ > _Design_, Click _Patterns_ > _General_. Choose the matching Template Part, then use the inserter to add the Synced Pattern to your Template Part*.
1. You can now add that Synced Pattern to posts or pages in the Content Editor... **or** you can add the Template Part to PHP theme files using `<?php block_template_part( 'img-grid-assoc-construction' ); ?>`. **Same actual content; both places**!

\* Note: You will need to repeat this process in each environment your site exists in (i.e. local, staging, production).
