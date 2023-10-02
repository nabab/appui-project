<!-- HTML Document -->

<div class="appui-project-ui bbn-overlay bbn-flex-width">
  <div class="bbn-padded bbn-h-100 bbn-xxl bbn-bordered-right">
    <div class="project_ide-navbar">
      <div bbn-for="(m, i) in menu"
           class="bbn-top-sspace bbn-p">
        <a :href="root + m.url"
           tabindex="0"
           :title="m.title">
          <i :class="[m.icon, 'bbn-reactive-text', {'bbn-text': i === pageSelected}]"/>
        </a>
      </div>
    </div>
  </div>
  <div class="bbn-flex-fill bbn-h-100">
    <div class="bbn-overlay">
      <bbn-router :autoload="false"
                  :root="root"
                  @route="onRoute"
                  def="home"
                  ref="router">
        <bbn-container url="home"
                       :load="true"/>
        <bbn-container url="ide"
                       component="appui-ide-editor"
                       :source="source"/>
        <bbn-container url="database"
                       :scrollable="false">
          <div class="bbn-overlay bbn-flex-height">
            <bbn-toolbar>
              <div>
                <bbn-dropdown :source="source.project.db.items"
                              v-model="databaseDb"
                              source-value="code"
                              :placeholder="_('Select a database')"/>
                &nbsp;
                <bbn-dropdown bbn-if="databaseDb"
                              bbn-model="databaseHost"
                              :source="connections"
                              source-value="alias.code"
                              source-value="alias.text"
                              :placeholder="_('Select a host')"/>
              </div>
            </bbn-toolbar>
            <div class="bbn-flex-fill">
              <bbn-router :autoload="true"
                          ref="dbRouter"
                          :nav="false">
            </div>

          </div>
        </bbn-container>
        <bbn-container url="finder"
                       component="appui-ide-finder"/>
      </bbn-router>
    </div>
  </div>
</div>