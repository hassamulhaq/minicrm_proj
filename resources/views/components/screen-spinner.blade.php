<style>
    div#screen-spinner {
        background: rgba(255, 255, 255, 0.7);
        width: 100vw;
        height: 100vh;
        filter: blur(4);
        z-index: 1200;
    }
</style>
<div id="screen-spinner" class="invisible screen-spinner fixed top-0 left-0 flex flex-col items-center justify-center h-screen w-screen backdrop-blur-sm">
    <div role="status">
        <div class="spinner-border text-primary"></div>
        <span class="sr-only">Loading...</span>
    </div>
</div>
