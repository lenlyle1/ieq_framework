{extends file='../site_base.tpl'}

{block name="content"}

    <div>
        Welcome to the site
    </div>

    <div>
    {for $count = 1 to 10}
        line {$count} <br />
    {/for}
    </div>


{/block}
