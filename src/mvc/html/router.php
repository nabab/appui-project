<div class="bbn-overlay bbn-padding">
  <bbn-table ref="table"
             :source="source.data"
             class="bbn-w-100"
             :toolbar="$options.components.toolbar"
             :order="[{field: 'project', dir: 'ASC'}]">
    <bbns-column label="<?= _("Project") ?>"
                 field="project"
                 :sortable="false"
                 min-width="15rem"/>

    <bbns-column label="APP"
                 field="app"
                 width="4rem"
                 cls="bbn-c"/>
  
    <bbns-column label="CDN"
                 field="cdn"
                 width="4rem"
                 cls="bbn-c"/>
    
    <bbns-column label="LIB"
               	 field="lib"
                 width="4rem"
                 cls="bbn-c"/>

    <bbns-column label="<?= _("Tot. repo.") ?>"
                 flabel="<?= _("Total number of repositories") ?>"
                 field="repositories"
                 width="8rem"
                 cls="bbn-c"/>
    <bbns-column :buttons="buttons"
                 width="6rem"/>
  </bbn-table>
</div>