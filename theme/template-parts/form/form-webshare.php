<?php
/**
 * WebShare partial
 *
 * "User-friendly social sharing component that works for everyone, using built-in APIs and progressive enhancement." - Andy Bell
 *
 * Adapted from example at: https://set.studio/simplify-sharing-with-built-in-apis-and-progressive-enhancement/
 */
?>

<script type="module">
import {createApp} from 'https://unpkg.com/petite-vue@0.2.2/dist/petite-vue.es.js';

const share = ({title, url}) => {
  return {
    title,
    url,
    webShareSupported: navigator.share,
    clipboardSupported: navigator.clipboard,
    shareFeedback: '',
    copyFeedback: '',
    noOptionsAvailable() {
      return !this.clipboardSupported && !this.webShareSupported;
    },
    share() {
      navigator
        .share({
          title,
          url,
          text: title,
        })
        .then(() => {
          this.shareFeedback = 'Thanks!';

          setTimeout(() => {
            this.shareFeedback = '';
          }, 3000);
        })
        .catch((error) => console.error('Error sharing', error));
    },
    copyLink() {
      navigator.clipboard
        .writeText(url)
        .then(() => {
          this.copyFeedback = 'Link copied!';

          setTimeout(() => {
            this.copyFeedback = '';
          }, 3000);
        })
        .catch((error) => console.error(error));
    },
  };
};

createApp({share}).mount();
</script>

<div
  id="share"
  tabindex="-1"
  class="my-8 lg:my-12 print:hidden"
  v-scope="share({ url:'<?php echo get_permalink(); ?>', title: '<?php the_title(); ?>' })"
  data-share-url="<?php echo get_permalink(); ?>"
  data-share-title="<?php the_title(); ?>"
>
  <p v-if="clipboardSupported || webShareSupported" class="mb-2 text-xl font-semibold font-head text-neutral-700 dark:text-neutral-400">Share with your network</p>
  <div v-if="!clipboardSupported && !webShareSupported">
    <p>Copy this link:</p>
    <p><code><?php echo get_permalink(); ?></code></p>
  </div>
  <div :class="!noOptionsAvailable() ? 'flex gap-2' : null" hidden :hidden="noOptionsAvailable()">
    <div class="relative" v-if="webShareSupported">
      <button class="inline-flex items-center justify-center px-5 py-3 font-bold no-underline border-2 rounded-lg text-aqua-800 font-head shadow-neutral-800 hover:shadow-xl focus:outline-none focus:ring focus:ring-aqua-200/80 sm:w-auto lg:text-lg border-aqua-800 hover:bg-aqua-800 hover:text-white dark:border-aqua-200 dark:text-aqua-200 dark:hover:text-neutral-800 dark:hover:bg-aqua-200" data-theme="ghost" @click="share">
        <span><i class="fa-solid fa-share"></i> Share</span>
      </button>
      <p role="alert" aria-live="polite" id="shareFeedback" class="context-alert" data-state="empty" :data-state="shareFeedback.length ? null : 'empty'">{{ shareFeedback }}</p>
    </div>
    <div class="relative" v-if="clipboardSupported">
      <button class="inline-flex items-center justify-center px-5 py-3 font-bold no-underline border-2 rounded-lg text-aqua-800 font-head shadow-neutral-800 hover:shadow-xl focus:outline-none focus:ring focus:ring-aqua-200/80 sm:w-auto lg:text-lg border-aqua-800 hover:bg-aqua-800 hover:text-white dark:border-aqua-200 dark:text-aqua-200 dark:hover:text-neutral-800 dark:hover:bg-aqua-200" data-theme="ghost" @click="copyLink">
        <span><i class="fa-solid fa-copy"></i> Copy link</span>
      </button>
      <p role="alert" aria-live="polite" id="copyFeedback" class="context-alert" data-state="empty" :data-state="copyFeedback.length ? null : 'empty'">{{ copyFeedback }}</p>
    </div>
  </div>
</div>
