<script setup>
import { switchTheme } from '../theme';
import NavLink from '../Components/NavLink.vue'; // import NavLink

                <NavLink routeName="register" componentName="Auth/Register">
                    Register
                </NavLink>
                <button
                    @click="switchTheme()" 
                    class=" hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white" >
                    
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
                
            </div>
        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
