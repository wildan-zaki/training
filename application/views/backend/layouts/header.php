<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/util.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/geocoder.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/map.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/marker.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/controls.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/places_impl.js"></script>
<style type="text/css">.gm-style {
        font: 400 11px Roboto, Arial, sans-serif;
        text-decoration: none; 
      }
      .gm-style img { max-width: none; }</style>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/onion.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/32/13/stats.js"></script>

<!--<ul class="top_links">-->
<!--    <li>-->
<!--        <a href="tasks_summary.html"><span>23</span>Tasks</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="mail_inbox.html"><span>8</span>Mails</a>-->
<!--    </li>-->
<!--</ul>-->
<ul class="nav navbar-nav navbar-right">
<!--    <li class="lang_menu">-->
<!--        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--            <span class="flag-US"></span> <span class="caret"></span>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu dropdown-menu-right">-->
<!--            <li><a href="user_profile.html"><span class="flag-FR"></span> France</a></li>-->
<!--            <li><a href="mail_inbox.html"><span class="flag-IN"></span> India</a></li>-->
<!--            <li><a href="tasks_summary.html"><span class="flag-BR"></span> Brasil</a></li>-->
<!--            <li><a href="tasks_summary.html"><span class="flag-GB"></span> UK</a></li>-->
<!--        </ul>-->
<!--    </li>-->
    <li class="user_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="navbar_el_icon ion-person"></span> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="<?=base_url('backend/user/view/' . $this->session->userdata('fuserid'))?>">Profile</a></li>
<!--            <li><a href="mail_inbox.html">My messages</a></li>-->
<!--            <li><a href="tasks_summary.html">My tasks</a></li>-->
            <li class="divider"></li>
            <li><a href="<?=base_url('backend/logout')?>">Log Out</a></li>
        </ul>
    </li>
    <!-- <li><a href="javascript:void(0)" class="slidebar-toggle"><span class="navbar_el_icon ion-navicon-round"></span></a></li> -->
</ul>