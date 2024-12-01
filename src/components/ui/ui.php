<!-- HTML Document -->

<div class="appui-project-ui bbn-overlay bbn-flex-width">
  <div class="bbn-vpadding bbn-hspadding bbn-h-100 bbn-xxl bbn-border-right bbn-background-primary">
    <div class="project_ide-navbar">
      <div bbn-for="(m, i) in menu"
           class="bbn-top-sspace bbn-p">
        <a :href="root + m.url"
           tabindex="0"
           :title="m.title"
           :class="{'bbn-primary': true, 'selected': i === pageSelected}">
          <i :class="m.icon"/>
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
        <bbn-container url="home">
          <div class="appui-project-ui-home">
            <div class="bbn-padding h-container">
              <div class="bbn-flex-width">
                <div class="bbn-flex-fill bbn-padding bbn-margin nav1 bbn-lradius">
                  <h1><?= _("It's not just about <em>edition</em>...<br>What evolved is <em>Creation</em> !") ?></h1>
                  <!--h2 class="starter">Starter Guide <i class="nf nf-md-television_guide"></i></h2-->
                  <br><br>
                  <h3 class="quick"><?= _("Quick Access") ?></h3>
                  <ul class="start">
                    <li>
                      <i class="nf nf-fa-image bbn-left-siconblock"></i>
                      <a :href="core + 'iconology'" v-text="_('Iconology')"></a><br>
                      <span><?= _("Access all available fonts for your app") ?></span>
                    </li>
                    <li>
                      <i class="nf nf-fa-font bbn-left-siconblock"></i>
                      <a :href="core + 'special_chars'" v-text="_('Chartology')"></a><br>
                      <span><?= _("See the whole special characters map") ?></span>
                    </li>
                    <li>
                      <i class="nf nf-fa-info_circle bbn-left-siconblock"></i>
                      <a :href="root + 'constants'" v-text="_('Constants')"></a><br>
                      <span><?= _("Access all bbn ide constants variables") ?></span>
                    </li>
                    <li>
                      <i class="nf nf-fa-file_text bbn-left-siconblock"></i>
                      <a :href="root + 'logs'" v-text="_('Log Viewer')"></a><br>
                      <span><?= _("Access bbn ide logs to debug errors or more") ?></span>
                    </li>
                    <li>
                      <i class="nf nf-mdi-apple_finder bbn-large bbn-left-siconblock"></i>
                      <a :href="root + 'finder'" v-text="_('Finder')"></a><br>
                      <span><?= _("Access bbn ide file finder") ?></span>
                    </li>
                    <li>
                      <i class="nf nf-seti-php bbn-left-siconblock"></i>
                      <a :href="root + 'profiler'" v-text="_('PHP Profiler')"></a><br>
                      <span><?= _("Access php profiler to profile and benchmark your php scripts") ?></span>
                    </li>
                  </ul>
                  <br><br>
                  <h3 class="recent-files">Recents Files</h3>
                  <ul class="recent">
                    <li><i class="nf nf-cod-file_code bbn-left-siconblock"></i>
                    <a href="#">easdsqxas</a></li>
                  </ul>
                </div>
                <div class="bbn-padding bbn-margin nav2 bbn-lradius">
                  <br><br>
                  <h2>Documentation  <i class="nf nf-md-file_document_edit"></i></h2>
                  <div class="doc-container bbn-padding  bbn-sradius">
                    <a :href="root + 'bbn-readme'">
                      <p class="doc">Read, manage and publish your project and libraries' documentation.</p>
                    </a>
                  </div>
                  <h2>Featured Tools <i class="nf nf-fae-tools"></i></h2>
                  <div class="tool-container bbn-sradius">
                    <a :href="root + 'dns'">
                      <div class="bbn-iblock bbn-space bbn-c bbn-padding dns bbn-radius bbn-white">
                        <i class="nf nf-mdi-dns"></i>
                        Dns Tool
                      </div>
                    </a>
                    <a :href="root + 'session'">
                      <div class="bbn-iblock bbn-space bbn-c bbn-padding session bbn-radius bbn-white">
                        <i class="nf nf-fa-user_secret"></i>
                        Sesssion Infos
                      </div>
                    </a>
                    <a :href="root + 'service-worker'">
                      <div class="bbn-iblock bbn-space bbn-c bbn-padding service-worker bbn-radius bbn-white">
                        <i class="nf nf-cod-dashboard"></i>
                        Service Worker
                      </div>
                    </a>
                    <a href="#">
                      <div class="bbn-iblock bbn-space bbn-c bbn-padding file-explorer bbn-radius bbn-white">
                        <i class="nf nf-md-file_cabinet"></i>
                        File Explorer
                      </div>
                    </a>
                  </div>
                  <h2>Upcoming Tools <i class="nf nf-dev-mootools_badge"></i></h2>
                  <div class="untool-container bbn-w-100 bbn-sradius">
                    <div class="bbn-w-100">
                      <a href="#">
                        <div class="bbn-block bbn-space bbn-c bbn-padding class-editor bbn-radius">
                          <i class="nf nf-seti-php"></i>
                          Class Editor
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>          
        </bbn-container>
        <bbn-container url="ide"
                       component="appui-ide-editor"
                       :source="source"
                       :options="{
                          storage: true,
                          storageFullName: 'appui-ide-editor-' + source.project.id
                       }"/>
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