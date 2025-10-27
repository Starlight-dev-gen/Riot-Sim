extends Node
@export var enemy_scene : PackedScene
var score
var hp = 3
var Timer_label = null
var Health_label = null


# Called when the node enters the scene tree for the first time.
func _ready() -> void:
	_new_game()
	Globals.time = 0
	Timer_label = get_node("HBoxContainer").find_child("Timer")
	Health_label = get_node("HBoxContainer2").find_child("health")


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta: float) -> void:
	Globals.time += delta
	Timer_label.text = str(round(Globals.time)).trim_suffix(".0")
	Health_label.text = str(hp)

	# if(Input.is_action_pressed("Instant_death")) :
	# 	get_tree().change_scene_to_file("res://Scenes/death.tscn")


func _on_player_hit() -> void:
	if hp == 1:
		_game_over()
	else:
		hp -=1


func _game_over():
	get_node("ScoreTimer").stop()
	get_node("EnemyTimer").stop()
	get_tree().change_scene_to_file("res://Scenes/death.tscn")


func _new_game():
	score = 0
	get_node("Player").position = (get_node("StartPosition").position)
	get_node("StartTimer").start()


func _on_enemy_timer_timeout() -> void:
	var enemy = enemy_scene.instantiate() # Create a new instance of the enemy.
	var enemy_spawn_loc = get_node("EnemyPath/EnemySpawnPosition") # Choose random location on path.
	enemy_spawn_loc.progress_ratio = randf()
	enemy.position = enemy_spawn_loc.position # Send enemy to random position.
	var direction = enemy_spawn_loc.rotation + PI / 2 # Turn enemy perpendicular to path (90°).
	direction += randf_range(-PI / 4, PI / 4) # Randomise direction (within 45°).
	# enemy.rotation = direction # Apply rotations.
	var velocity = Vector2(randf_range(200.0, 300), 0.0) # Make random velocity vector.
	enemy.linear_velocity = velocity.rotated(direction) # Turn vector to direction.
	add_child(enemy) # Spawn the poor sod.


func _on_score_timer_timeout() -> void:
	score += 1


func _on_start_timer_timeout() -> void:
	get_node("ScoreTimer").start()
	get_node("EnemyTimer").start()
