<!-- HTML Document -->

<div class="bbn-overlay bbn-flex-width project_ide">
  <div class="bbn-padded bbn-h-100 bbn-xxl bbn-bordered-right">
    <div class="project_ide-navbar">
      <div class="bbn-top-sspace bbn-p bbn-reactive-text"
           tabindex="0"
           @click="route('home')">
        <i class="nf nf-fa-home"/>
      </div>
      <div class="bbn-top-sspace bbn-p"
           tabindex="0"
           @click="route('ide')">
        <i class="nf nf-fa-code"/>
      </div>
      <div class="bbn-top-sspace bbn-p"
           tabindex="0"
           @click="route('database')">
        <i class="nf nf-fa-database bbn-top-space"/>
      </div>
      <div class="bbn-top-sspace bbn-p"
           tabindex="0"
           @click="route('finder')">
        <i class="nf nf-mdi-apple_finder bbn-top-sspace"/>
      </div>
    </div>
  </div>
  <div class="bbn-flex-fill bbn-h-100">
    <div class="bbn-overlay">
      <bbn-router :autoload="false"
                  :root="ide_root + source.project.id"
                  ref="router">
        <bbn-container url="ide"
                       component="appui-ide-editor"
                       :source="source">
        </bbn-container>
        <bbn-container url="database"
                       component="appui-database-dashboard">
        </bbn-container>
        <bbn-container url="finder"
                       component="appui-ide-finder">
        </bbn-container>
      </bbn-router>
    </div>
  </div>
</div>
